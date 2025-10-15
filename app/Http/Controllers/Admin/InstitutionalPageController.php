<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionalPageRequest;
use App\Models\InstitutionalPage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class InstitutionalPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $pages = InstitutionalPage::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');

                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('title', 'like', '%' . $search . '%')
                        ->orWhere('slug', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('title')
            ->paginate(10)
            ->withQueryString();

        return view('admin.institutional_pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $page = new InstitutionalPage();

        return view('admin.institutional_pages.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstitutionalPageRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request->validated());

        try {
            InstitutionalPage::create($data);

            return redirect()
                ->route('institutional-pages.index')
                ->with('status', 'institutional-page-created');
        } catch (\Throwable $exception) {
            Log::error('Erro ao criar página institucional', [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Não foi possível criar a página. Tente novamente.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstitutionalPage $institutional_page): View
    {
        return view('admin.institutional_pages.edit', ['page' => $institutional_page]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstitutionalPageRequest $request, InstitutionalPage $institutional_page): RedirectResponse
    {
        $data = $this->prepareData($request->validated());

        try {
            $institutional_page->update($data);

            return redirect()
                ->route('institutional-pages.index')
                ->with('status', 'institutional-page-updated');
        } catch (\Throwable $exception) {
            Log::error('Erro ao atualizar página institucional', [
                'page_id' => $institutional_page->id,
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Não foi possível atualizar a página. Tente novamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstitutionalPage $institutional_page): RedirectResponse
    {
        try {
            $institutional_page->delete();

            return redirect()
                ->route('institutional-pages.index')
                ->with('status', 'institutional-page-deleted');
        } catch (\Throwable $exception) {
            Log::error('Erro ao excluir página institucional', [
                'page_id' => $institutional_page->id,
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);

            return redirect()
                ->route('institutional-pages.index')
                ->with('error', 'Não foi possível excluir a página. Tente novamente.');
        }
    }

    /**
     * Prepare data before persisting.
     */
    private function prepareData(array $data): array
    {
        $data['slug'] = Str::slug($data['slug']);
        $data['is_active'] = $data['is_active'] ?? false;

        return $data;
    }
}
