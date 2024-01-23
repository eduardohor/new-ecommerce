<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

            $path = $request->file('image')->store('categories');

            $data['image'] = $path;

            $this->category->create($data);

            DB::commit();

            return redirect()->route('categories.index')->with('status', 'category-created');
        } catch (\Exception  $error) {
            DB::rollBack();

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

            if ($request->has('image')) {
                Storage::delete($category->image);
                $path = $request->file('image')->store('categories');
                $data['image'] = $path;
            }

            $category->update($data);

            DB::commit();

            return redirect()->route('categories.index')->with('status', 'category-updated');
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('categories.index')->with('error', 'Erro ao atualizar categoria. Por favor, tente novamente.');
        }
    }

    public function destroy(string|int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $category = $this->findCategoryOrFail($id);

            Storage::delete($category->image);

            $category->delete();

            DB::commit();

            return redirect()->route('categories.index')->with('status', 'category-deleted');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('categories.index')->with('error', 'Erro ao excluir categoria. Por favor, tente novamente.');
        }
    }

    private function findCategoryOrFail(string|int $id): Model
    {
        try {
            return $this->category->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $redirectResponse = redirect()->route('categories.index')->with('error', 'Categoria não encontrada');
            $redirectResponse->send();  // Encerra a execução imediatamente
        }
    }
}
