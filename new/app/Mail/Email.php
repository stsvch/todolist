<?php

namespace App\Mail;

use App\Models\user;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Reset password')
            ->view('email')->with([
                'reset_link' => route('password.reset.form', ['token' => $this->user->password_reset_token]),
            ]);
    }
}
