<?php

namespace App\Http\Composers;

use App\Models\InstitutionalPage;
use Illuminate\View\View;

class InstitutionalPageComposer
{
    public function compose(View $view): void
    {
        $pages = InstitutionalPage::active()
            ->orderBy('title')
            ->get(['id', 'title', 'slug']);

        $view->with([
            'institutionalPages' => $pages,
            'institutionalPagesBySlug' => $pages->keyBy('slug'),
        ]);
    }
}
