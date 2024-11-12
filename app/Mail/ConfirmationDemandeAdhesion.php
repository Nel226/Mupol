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
    protected  $generatedPassword;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $demandeAdhesion
     * @param  mixed  $pdf
     */
  
    public function __construct($demandeAdhesion, $pdf, $generatedPassword)
    {
        $this->demandeAdhesion = $demandeAdhesion;
        $this->pdf = $pdf;
        $this->generatedPassword = $generatedPassword; // Ajoutez ce champ
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Accusé de réception de votre demande d\'adhésion',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.accuse-reception-demande-adhesion', 
            with: [
                'demandeAdhesion' => $this->demandeAdhesion,
                'logoUrl' => asset('images/logo.png'), 
                'generatedPassword' => $this->generatedPassword, 

            ],
        );
    }

    /**
     * Build the message and attach the PDF file.
     */
    public function build()
    {
        return $this->view('emails.accuse-reception-demande-adhesion') 
                    ->subject('Confirmation de votre demande d\'adhésion')
                    ->attachData($this->pdf->output(), 'Fiche-cession-volontaire-de-salaire.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
