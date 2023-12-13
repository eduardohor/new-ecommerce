<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag(
            'updatePassword',
            [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ],
            [
                'current_password.required' => 'O campo senha atual é obrigatório.',
                'current_password.current_password' => 'A senha atual fornecida está incorreta.',
                'password.required' => 'O campo nova senha é obrigatório.',
                'password.password' => 'A nova senha deve atender aos requisitos de segurança.',
                'password.confirmed' => 'A confirmação da nova senha não corresponde.',
                'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            ]
        );

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
