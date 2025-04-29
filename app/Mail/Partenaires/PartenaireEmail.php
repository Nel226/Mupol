<?php

namespace App\Mail\Partenaires;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PartenaireEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $contenu;
    public $objet;

    public function __construct($contenu, $objet)
    {
        $this->contenu = $contenu;
        $this->objet = $objet;
    }

    public function build()
    {
        return $this->subject($this->objet)
                    ->view('emails.partenaires.email')
                    ->with([
                        'contenu' => $this->contenu,
                        'logoUrl' => asset('images/logo.png'), 

                    ]);
    }
}
