<?php

namespace App\Jobs;

use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PasswordResetEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $email)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::where('email', $this->email)->first();

        Log::info('Usuário encontrado:', ['user' => $user]);

        // Gera um token usando o sistema nativo do Laravel, que controla a expiração
        $token = app()->get(PasswordBroker::class)->createToken($user);

        // Gera a URL de redefinição de senha usando o token criado
        $resetUrl = url("redefinir-senha/{$token}") . "?email=" . urlencode($this->email);

        // Envia o email com o link de redefinição de senha
        Mail::to($this->email)->send(new PasswordResetMail($user, $resetUrl));
    }
}
