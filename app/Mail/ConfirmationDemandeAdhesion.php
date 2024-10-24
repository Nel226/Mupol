<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class ConfirmationDemandeAdhesion extends Mailable
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
            subject: 'Confirmation de votre demande d\'adhésion',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmation', // Assurez-vous que la vue est correcte
            with: [
                'demandeAdhesion' => $this->demandeAdhesion,
                'logoUrl' => asset('images/logo.png'), // Chemin vers votre logo
            ],
        );
    }

    /**
     * Build the message and attach the PDF file.
     */
    public function build()
    {
        return $this->view('emails.confirmation') 
                    ->subject('Confirmation de votre demande d\'adhésion')
                    ->attachData($this->pdf->output(), 'Fiche-cession-volontaire-de-salaire.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
