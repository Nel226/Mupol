<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PartenaireAdhesion extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $password;

    /**
     * Crée une nouvelle instance de message.
     *
     * @param  string  $email
     * @param  string  $password
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Retourne l'enveloppe du message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre adhésion',
        );
    }

    /**
     * Retourne la définition du contenu du message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.partenaire-adhesion', 
            with: [
                'email' => $this->email,
                'password' => $this->password,
                'logoUrl' => asset('images/logo.png'),  // Logo à ajouter dans l'email
            ],
        );
    }
}
