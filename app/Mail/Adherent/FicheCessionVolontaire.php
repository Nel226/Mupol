<?php

namespace App\Mail\Adherent;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FicheCessionVolontaire extends Mailable
{
    use Queueable, SerializesModels;

    public $demandeAdhesion;
    protected $pdf;
    /**
     * Create a new message instance.
     *
     * @param  mixed  $demandeAdhesion
     * @param  mixed  $pdf
     */
    public function __construct($demandeAdhesion, $pdf)
    {
        $this->demandeAdhesion = $demandeAdhesion;
        $this->pdf = $pdf;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Fiche Cession Volontaire de Salaire',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.adherents.fiche-cession-volontaire', 
            with: [
                'adherent' => $this->demandeAdhesion,
                'logoUrl' => asset('images/logo.png'), 

            ],
        );
    }

    /**
     * Build the message and attach the PDF file.
     */
    public function build()
    {
        return $this->view('emails.adherents.fiche-cession-volontaire') 
                    ->subject('Fiche Cession Volontaire de Salaire')
                    ->attachData($this->pdf->output(), 'Fiche-cession-volontaire-de-salaire.pdf', [
                        'mime' => 'application/pdf',
        ]);
    }
}
