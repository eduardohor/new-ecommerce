<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $categories = $this->category->getCategories($request->get('search', ''));
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->category->all();

        return view('admin.category.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        $data['parent_id'] = null;

        if ($request->filled('parent_id')) {
            $data['parent_id'] = $request->parent_id;
        }

        $path = $request->file('image')->store('categories');

        $data['image'] = $path;

        $this->category->create($data);

        return redirect()->back()->with('status', 'category-created');
    }

    public function edit($id)
    {
        $category = $this->findCategoryOrFail($id);

        $categories = $this->category->all();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $this->findCategoryOrFail($id);

        $data = $request->all();

        if ($request->has('image')) {
            Storage::delete($category->image);
            $path = $request->file('image')->store('categories');
            $data['image'] = $path;
        }

        $category->update($data);

        if ($category->wasChanged()) {
            return redirect()->back()->with('status', 'category-updated');
        } else {
            return redirect()->back()->with('warning', 'Nenhuma alteração detectada na categoria');
        }
    }

    public function destroy($id)
    {
        $category = $this->findCategoryOrFail($id);

        Storage::delete($category->image);

        $category->delete();

        return redirect()->back()->with('status', 'category-deleted');
    }

    private function findCategoryOrFail($id)
    {
        try {
            return $this->category->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $redirectResponse = redirect()->route('categories.index')->with('error', 'Categoria não encontrada');
            $redirectResponse->send();  // Encerra a execução imediatamente
        }
    }
}
