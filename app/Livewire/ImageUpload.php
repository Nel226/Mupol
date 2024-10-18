<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $photo, $imageUrl; 

    public function render()
    {
        return view('livewire.image-upload');
    }
    public function saveImage()
    {
        
        // $this->validate([
        //     'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);
        

        if ($this->photo) {
            // Sauvegarder l'image dans storage/app/public/images
            $path = $this->photo->storeAs('public/photos', $this->photo->getClientOriginalName());
            dd($path);
            // Vous pouvez sauvegarder l'URL publique du fichier pour l'utiliser plus tard
            $this->imageUrl = asset('storage/images/' . $this->photo->getClientOriginalName());

            // On met à jour la variable photo dans le composant parent (WizardMembership)
            $this->emitUp('imageUploaded', $this->imageUrl);
        }
    }
}
