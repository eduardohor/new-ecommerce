<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\PasswordResetEmailJob;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', Rule::exists('users', 'email')],
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O endereço de e-mail deve ser válido.',
            'email.exists' => 'Não conseguimos encontrar um usuário com esse endereço de e-mail.',
        ]);

        PasswordResetEmailJob::dispatch($request->email)->onQueue('default');

        return redirect()->back()->with('status', 'Enviamos por e-mail seu link de redefinição de senha.');

    }
}
