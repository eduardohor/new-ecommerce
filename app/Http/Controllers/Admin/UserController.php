<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredUserRequest;
use App\Http\Requests\UserUpdateRequest;
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

    public function edit($id): View
    {
        if (!$user = $this->user->find($id)) {
            return redirect('users.index');
        }

        return view('admin.user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id): RedirectResponse
    {
        if (!$user = $this->user->find($id)) {
            return redirect('users.index');
        }

        $is_super_admin = 0;

        if ($request->has('is_super_admin')) {
            $is_super_admin = 1;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_super_admin' => $is_super_admin
        ]);

        return redirect()->back()->with('status', 'user-updated');
    }
}
