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

        $token = app()->get(PasswordBroker::class)->createToken($user);

        $resetUrl = url("redefinir-senha/{$token}") . "?email=" . urlencode($this->email);

        Mail::to($this->email)->send(new PasswordResetMail($user, $resetUrl));
    }
}
