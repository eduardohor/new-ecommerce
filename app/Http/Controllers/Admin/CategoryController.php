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
        dd($request->all());
        $data = $request->all();

        $data['parent_id'] = null;

        $request->filled('parent_id') ? $data['parent_id'] = $request->parent_id : null;

        $path = $request->file('image')->store('categories');

        $data['image'] = $path;

        $this->category->create($data);

        return redirect()->route('categories.index')->with('status', 'category-created');
    }

    public function edit(string|int $id): View
    {
        $category = $this->findCategoryOrFail($id);

        $categories = $this->category->all();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, string|int $id): RedirectResponse
    {
        $category = $this->findCategoryOrFail($id);

        $data = $request->all();

        if ($request->has('image')) {
            Storage::delete($category->image);
            $path = $request->file('image')->store('categories');
            $data['image'] = $path;
        }

        $category->update($data);

        if (!$category->wasChanged()) {
            return redirect()->route('categories.index')->with('warning', 'Nenhuma alteração detectada na categoria');
        }

        return redirect()->route('categories.index')->with('status', 'category-updated');
    }

    public function destroy(string|int $id): RedirectResponse
    {
        $category = $this->findCategoryOrFail($id);

        Storage::delete($category->image);

        $category->delete();

        if ($category->wasChanged()) {
            return redirect()->route('categories.index')->with('warning', 'Nenhuma alteração detectada na categoria');
        }

        return redirect()->route('categories.index')->with('status', 'category-deleted');
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
