<?php

namespace App\Livewire;

use Livewire\Component;

class SignaturePad extends Component
{
    public $signatureText = '';

    public function render()
    {
        return view('livewire.signature-pad');
    }

    public function saveSignature()
    {
        // Ici, vous pouvez traiter la signature textuelle, par exemple, l'enregistrer dans la base de données
        dd($this->signatureText);
    }
}