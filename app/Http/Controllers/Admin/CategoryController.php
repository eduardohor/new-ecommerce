<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return view('admin.category.index');
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

        $slug = Str::slug($request->slug);

        $path = $request->file('image')->store('categories');

        $data['image'] = $path;

        $data['slug'] = $slug;

        $this->category->create($data);

        return redirect()->back()->with('status', 'category-created');
    }
}
