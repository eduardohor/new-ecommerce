<?php

namespace App\Http\Composers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteComposer
{

    public function compose(View $view)
    {
        $user = Auth::user();
        if ($user) {
            $favoritesProvider = $user->favorites()->count();
        } else {
            $favoritesProvider = 0;
        }

        $view->with('favoritesProvider', $favoritesProvider);
    }
}
