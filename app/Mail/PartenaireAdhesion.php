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
    public $partenaire;
    public $password;
    /**
     * Create a new message instance.
     */
 
     public function __construct($partenaire, $password)
    {
        $this->partenaire = $partenaire;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Partenaire Adhesion MU-POL',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.partenaire-adhesion', 
            
            with: [
                'email' => $this->partenaire->email,
                'password' => $this->password,
                'logoUrl' => asset('images/logo.png'), 

            ],
        );
    }
    
    public function build()
    {
        return $this->view('emails.partenaire-adhesion') 
                    ->subject('Bienvenue à la MU-POL')
                    ->with([
                        'name' => $this->partenaire->name,
                        'email' => $this->partenaire->email, 
                        'password' => $this->password,
                    ]);
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
