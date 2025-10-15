<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\InstitutionalPage;
use Illuminate\Contracts\View\View;

class InstitutionalPageController extends Controller
{
    public function show(string $slug): View
    {
        $page = InstitutionalPage::active()->where('slug', $slug)->firstOrFail();

        return view('front.pages.institutional', compact('page'));
    }
}
