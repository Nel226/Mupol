<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $photo;

    public function render()
    {
        return view('livewire.image-upload');
    }

    public function saveImage()
    {
        if ($this->photo) {
            $this->emitUp('imageUploaded', $this->photo); // Émet l'image au composant parent
        }
    }
}

