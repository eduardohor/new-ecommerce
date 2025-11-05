<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function index(Request $request): View
    {
        $positions = config('banners.positions', []);

        $banners = Banner::query()
            ->when($request->filled('position'), fn ($query) => $query->where('position', $request->position))
            ->when($request->filled('status'), function ($query) use ($request) {
                if ($request->status === 'active') {
                    $query->where('is_active', true);
                } elseif ($request->status === 'inactive') {
                    $query->where('is_active', false);
                }
            })
            ->orderBy('position')
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        return view('admin.banner.index', compact('banners', 'positions'));
    }

    public function create(): View
    {
        $positions = config('banners.positions', []);

        return view('admin.banner.create', compact('positions'));
    }

    public function store(BannerRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request);

        $maxItems = data_get(config('banners.positions.' . $data['position']), 'max_items');

        if ($maxItems && Banner::forPosition($data['position'])->count() >= $maxItems) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Limite de banners para esta posição atingido.');
        }

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $data['image_path'] = $request->file('image')->store('banners', 'public');
            }

            if ($request->hasFile('mobile_image')) {
                $data['mobile_image'] = $request->file('mobile_image')->store('banners', 'public');
            }

            Banner::create($data);

            DB::commit();

            return redirect()->route('banners.index')->with('status', 'banner-created');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao criar banner:', [
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ]);

            return redirect()->route('banners.index')->with('error', 'Erro ao criar banner. Por favor, tente novamente.');
        }
    }

    public function edit(int $id): View
    {
        $banner = Banner::findOrFail($id);
        $positions = config('banners.positions', []);

        return view('admin.banner.edit', compact('banner', 'positions'));
    }

    public function update(BannerRequest $request, int $id): RedirectResponse
    {
        $banner = Banner::findOrFail($id);
        $data = $this->prepareData($request);

        try {
            DB::beginTransaction();

            if ($data['position'] !== $banner->position) {
                $maxItems = data_get(config('banners.positions.' . $data['position']), 'max_items');

                if ($maxItems && Banner::forPosition($data['position'])->count() >= $maxItems) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Limite de banners para esta posição atingido.');
                }
            }

            if ($request->hasFile('image')) {
                if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                    Storage::disk('public')->delete($banner->image_path);
                }

                $data['image_path'] = $request->file('image')->store('banners', 'public');
            }

            if ($request->hasFile('mobile_image')) {
                if ($banner->mobile_image && Storage::disk('public')->exists($banner->mobile_image)) {
                    Storage::disk('public')->delete($banner->mobile_image);
                }

                $data['mobile_image'] = $request->file('mobile_image')->store('banners', 'public');
            }

            $banner->update($data);

            DB::commit();

            return redirect()->route('banners.index')->with('status', 'banner-updated');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao atualizar banner:', [
                'banner_id' => $banner->id,
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ]);

            return redirect()->route('banners.index')->with('error', 'Erro ao atualizar banner. Por favor, tente novamente.');
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $banner = Banner::findOrFail($id);

            if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }

            if ($banner->mobile_image && Storage::disk('public')->exists($banner->mobile_image)) {
                Storage::disk('public')->delete($banner->mobile_image);
            }

            $banner->delete();

            DB::commit();

            return redirect()->route('banners.index')->with('status', 'banner-deleted');
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();

            return redirect()->route('banners.index')->with('error', 'Banner não encontrado.');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao excluir banner:', [
                'banner_id' => $id,
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
            ]);

            return redirect()->route('banners.index')->with('error', 'Erro ao excluir banner. Por favor, tente novamente.');
        }
    }

    private function prepareData(BannerRequest $request): array
    {
        $data = $request->validated();

        unset($data['image'], $data['mobile_image']);

        if (isset($data['link_url'])) {
            $data['link_url'] = trim($data['link_url']) ?: null;

            if (!$data['link_url']) {
                $data['open_new_tab'] = false;
            }
        }

        return $data;
    }
}
