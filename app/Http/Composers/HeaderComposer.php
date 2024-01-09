<?php

namespace App\Http\Composers;

use App\Models\Category;
use Illuminate\View\View;

class HeaderComposer
{
  protected $category;

  public function __construct(Category $category)
  {
    $this->category = $category;
  }

  public function compose(View $view)
  {
    $categoriesProvider = $this->category->nestedCategories();
    $view->with('categoriesProvider', $categoriesProvider);
  }
}
