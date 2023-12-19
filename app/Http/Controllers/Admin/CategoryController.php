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

        // Verifica se a opção "Nenhuma (Categoria Principal)" foi selecionada
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
        try {
            $category = $this->category->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index')->with('error', 'Categoria não encontrada');
        }

        $categories = $this->category->all();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = $this->category->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('categories.index')->with('error', 'Categoria não encontrada');
        }

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
}
