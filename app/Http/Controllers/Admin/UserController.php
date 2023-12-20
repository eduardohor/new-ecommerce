<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

        return redirect()->route('users.index')->with('status', 'user-created');
    }

    public function edit(string|int $id): View
    {
        $user = $this->findUserOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, string|int $id): RedirectResponse
    {
        $user = $this->findUserOrFail($id);

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

        if (!$user->wasChanged()) {
            return redirect()->route('users.index')->with('warning', 'Nenhuma alteração detectada no usuário');
        }

        return redirect()->route('users.index')->with('status', 'user-updated');
    }

    public function destroy(string|int $id): RedirectResponse
    {
        $user = $this->findUserOrFail($id);

        $user->delete();

        return redirect()->route('users.index')->with('status', 'user-deleted');
    }

    private function findUserOrFail(string|int $id): Model
    {
        try {
            return $this->user->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            $redirectResponse = redirect()->route('users.index')->with('error', 'Usuário não encontrado');
            $redirectResponse->send();  // Encerra a execução imediatamente
        }
    }
}
