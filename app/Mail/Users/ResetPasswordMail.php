<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;
    public $type;

    /**
     * Créez une nouvelle instance de message.
     */
    public function __construct($token, $email, $type)
    {
        $this->token = $token;
        $this->email = $email;
        $this->type = $type;
    }

    /**
     * Construire le message.
     */
    public function build()
    {
        return $this->subject('Réinitialisation de votre mot de passe')
                    ->view('emails.reset-password')
                    ->with([
                        'token' => $this->token,
                        'email' => $this->email,
                        'type'  => $this->type,
                    ]);
    }
}
