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
use Illuminate\Support\Facades\DB;
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
        try {
            DB::beginTransaction();
            $this->user->create($request->all());


            DB::commit();

            return redirect()->route('users.index')->with('status', 'user-created');
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('users.index')->with('error', 'Erro ao criar usuário. Por favor, tente novamente.');
        }
    }

    public function edit(string|int $id): View
    {
        $user = $this->findUserOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, string|int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
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

            return redirect()->route('users.index')->with('status', 'user-updated');
            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('users.index')->with('error', 'Erro ao editar usuário. Por favor, tente novamente.');
        }
    }

    public function destroy(string|int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $user = $this->findUserOrFail($id);

            $user->delete();

            DB::commit();

            return redirect()->route('users.index')->with('status', 'user-deleted');
        } catch (\Exception $error) {
            DB::rollBack();

            return redirect()->route('users.index')->with('error', 'Erro ao excluir usuário. Por favor, tente novamente.');
        }
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
