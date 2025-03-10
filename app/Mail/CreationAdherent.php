<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class CreationAdherent extends Mailable
{
    use Queueable, SerializesModels;

    public $adherent;
    protected $pdf;
    protected  $generatedPassword;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $adherent
     * @param  mixed  $pdf
     */
  
    public function __construct($adherent, $pdf, $generatedPassword)
    {
        $this->adherent = $adherent;
        $this->pdf = $pdf;
        $this->generatedPassword = $generatedPassword; 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue à la MU-POL',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.creation-adherent', 
            with: [
                'adherent' => $this->adherent,
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
        return $this->view('emails.creation-adherent') 
                    ->subject('Bienvenue')
                    ->attachData($this->pdf->output(), 'Fiche-cession-volontaire-de-salaire.pdf', [
                        'mime' => 'application/pdf',
        ]);
    }
}
