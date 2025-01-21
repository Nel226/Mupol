<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationCreationCompte extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    
     use Queueable, SerializesModels;

     public $email;
     public $generatedPassword;
 
     /**
      * Create a new message instance.
      *
      * @param string $email
      * @param string $generatedPassword
      */
     public function __construct($email, $generatedPassword)
     {
         $this->email = $email;
         $this->generatedPassword = $generatedPassword;
     }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation Creation Compte',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmation-creation-compte', 
            with: [
                'email' => $this->email,
                'logoUrl' => asset('images/logo.png'), 
                'generatedPassword' => $this->generatedPassword, 

            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
