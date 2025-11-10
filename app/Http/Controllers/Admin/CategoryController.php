<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(Request $request): View
    {
        $categories = $this->category->getCategories($request->get('search', ''));
        return view('admin.category.index', compact('categories'));
    }

    public function create(): View
    {
        $categories = $this->category->all();

        return view('admin.category.create', compact('categories'));
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->all();

            $data['parent_id'] = null;

            $request->filled('parent_id') ? $data['parent_id'] = $request->parent_id : null;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('categories', 'public');
                $data['image'] = $path;
            } else {
                $data['image'] = null;
            }

            $this->category->create($data);

            DB::commit();

            return redirect()->route('categories.index')->with('status', 'category-created');
        } catch (\Exception  $error) {
            DB::rollBack();

            Log::error('Erro ao criar categoria:', [
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
                'trace' => $error->getTrace(),
            ]);

            return redirect()->route('categories.index')->with('error', 'Erro ao criar categoria. Por favor, tente novamente.');
        }
    }

    public function edit(string|int $id): View
    {
        $category = $this->findCategoryOrFail($id);

        $categories = $this->category->all();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, string|int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $category = $this->findCategoryOrFail($id);

            $data = $request->all();

            if ($request->hasFile('image')) {
                if ($category->image) {
                    Storage::delete($category->image);
                }
                $path = $request->file('image')->store('categories', 'public');
                $data['image'] = $path;
            } else {
                unset($data['image']);
            }
            

            $category->update($data);

            DB::commit();

            return redirect()->route('categories.index')->with('status', 'category-updated');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao editar categoria:', [
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
                'trace' => $error->getTrace(),
            ]);

            return redirect()->route('categories.index')->with('error', 'Erro ao atualizar categoria. Por favor, tente novamente.');
        }
    }

    public function destroy(string|int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $category = $this->findCategoryOrFail($id);

            if ($category->image) {
                Storage::delete($category->image);
            }

            $category->delete();

            DB::commit();

            return redirect()->route('categories.index')->with('status', 'category-deleted');
        } catch (\Exception $error) {
            DB::rollBack();

            Log::error('Erro ao excluir categoria:', [
                'message' => $error->getMessage(),
                'type' => get_class($error),
                'file' => $error->getFile(),
                'line' => $error->getLine(),
                'trace' => $error->getTrace(),
            ]);

            return redirect()->route('categories.index')->with('error', 'Erro ao excluir categoria. Por favor, tente novamente.');
        }
    }

    private function findCategoryOrFail(string|int $id): Model
    {
        try {
            return $this->category->findOrFail($id);
        } catch (ModelNotFoundException $error) {
            Log::error('Categoria não encontrada. Detalhes: ' . $error->getMessage());
            abort(404, 'Categoria não encontrada');
            throw $error; // Nunca alcançado, mas satisfaz o analisador estático
        }
    }
}
