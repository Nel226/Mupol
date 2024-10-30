<?php

namespace App\Livewire;

use App\Models\DemandeAdhesion;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditMembership extends Component
{
    use WithFileUploads;

    // Propriétés pour les données
    public $demandeAdhesion;
    public $matricule, $nip, $cnib, $delivree, $expire, $adresse_permanente, $telephone, $email;
    public $nom, $prenom, $genre, $departement, $ville, $pays, $nom_pere, $nom_mere, $situation_matrimoniale;
    public $nom_prenom_personne_besoin, $lieu_residence, $telephone_personne_prevenir, $photo, $photo_path_adherent, $photo_path_ayantdroit;
    public $dateIntegration, $dateDepartARetraite, $direction, $service, $statut;
    public $grade, $departARetraite, $numeroCARFO;
    public $nombreAyantsDroits;
    public $ayantsDroits = [];
    public $signature, $signatureImage;

    // Charger les données existantes pour l'édition
    public function mount($demandeAdhesionId)
    {
        $this->demandeAdhesion = DemandeAdhesion::findOrFail($demandeAdhesionId);

        $this->fill($this->demandeAdhesion->toArray());
        $this->ayantsDroits = json_decode($this->demandeAdhesion->ayantsDroits, true) ?? [];
    }

    // Méthode de validation
    public function validateFields()
    {
        $this->validate([
            'matricule' => 'required|min:3',
            'nip' => 'required',
            'cnib' => 'required',
            'delivree' => 'required|date',
            'expire' => 'required|date|after:delivree',
            'adresse_permanente' => 'required',
            'telephone' => 'required',
            'email' => 'required|email',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'genre' => 'required',
            'departement' => 'required|string',
            'ville' => 'required|string',
            'situation_matrimoniale' => 'required|string',
            'photo' => 'nullable|image|max:1024',
            'nom_prenom_personne_besoin' => 'required|string|max:255',
            'lieu_residence' => 'required|string|max:255',
            'telephone_personne_prevenir' => 'required',
            'nombreAyantsDroits' => 'required|integer',
            'statut' => 'required',
            'grade' => 'nullable|string',
            'departARetraite' => 'nullable|date',
            'numeroCARFO' => 'nullable|string',
            'dateIntegration' => 'nullable|date',
            'dateDepartARetraite' => 'nullable|date|after:dateIntegration',
            'direction' => 'nullable|string',
            'service' => 'nullable|string',
        ]);
    }

    // Enregistrement des modifications
    public function saveChanges()
    {
        $this->validateFields();

        // Mettre à jour les champs
        $this->demandeAdhesion->fill([
            'matricule' => $this->matricule,
            'nip' => $this->nip,
            'cnib' => $this->cnib,
            'delivree' => $this->delivree,
            'expire' => $this->expire,
            'adresse' => $this->adresse_permanente,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'genre' => $this->genre,
            'departement' => $this->departement,
            'ville' => $this->ville,
            'pays' => $this->pays,
            'nom_pere' => $this->nom_pere,
            'nom_mere' => $this->nom_mere,
            'situation_matrimoniale' => $this->situation_matrimoniale,
            'nom_prenom_personne_besoin' => $this->nom_prenom_personne_besoin,
            'lieu_residence' => $this->lieu_residence,
            'telephone_personne_prevenir' => $this->telephone_personne_prevenir,
            'photo' => $this->photo ? $this->photo->store('public/photos/adherents') : $this->photo_path_adherent,
            'nombreAyantsDroits' => $this->nombreAyantsDroits,
            'ayantsDroits' => json_encode($this->ayantsDroits),
            'statut' => $this->statut,
            'grade' => $this->grade,
            'departARetraite' => $this->departARetraite,
            'numeroCARFO' => $this->numeroCARFO,
            'dateIntegration' => $this->dateIntegration,
            'dateDepartARetraite' => $this->dateDepartARetraite,
            'direction' => $this->direction,
            'service' => $this->service,
        ]);

        $this->demandeAdhesion->save();

        session()->flash('message', 'Modifications enregistrées avec succès !');
        return redirect()->route('adhesion.index');
    }

    // Méthode pour mettre à jour la date d'expiration
    public function updateExpire()
    {
        if ($this->delivree) {
            $this->expire = \Carbon\Carbon::parse($this->delivree)->addYears(10)->toDateString();
        }
    }

    public function render()
    {
        return view('livewire.edit-membership');
    }
}

