<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index(Request $request): View
    {
        $users = $this->user->getUsers($request->get('search', ''));

        return view('admin.user.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.user.create');
    }

    public function store(RegisteredUserRequest $request): RedirectResponse
    {
        $this->user->create($request->all());

        return redirect()->back()->with('status', 'user-created');
    }
}
