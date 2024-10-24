<?php

namespace App\Livewire;

use App\Helpers\DemandeCategorieHelper;
use App\Models\DemandeAdhesion;
use Livewire\Component;
use Livewire\WithFileUploads;

class WizardMembership extends Component
{
    public $currentStep = 1; // Étape actuelle du wizard
    public $totalSteps = 5;   // Nombre total d'étapes  

    // Variables pour les données du formulaire
    public $matricule, $nip, $cnib, $delivree, $expire, $adresse_permanente, $telephone;
    public $email, $password, $nom, $prenom, $genre, $departement, $ville, $pays, $nom_pere, $nom_mere, $situation_matrimoniale;
    // Variables info personnnelles
    public $nom_prenom_personne_besoin, $lieu_residence, $telephone_personne_prevenir;
     // Propriétés pour les champs conditionnels
    // Variables pour le personnel en activité
    public $dateIntegration, $dateDepartARetraite, $direction, $service, $statut;

    public $imageUrl; // Photo URL
    protected $listeners = ['imageUploaded' => 'setImageUrl'];

    public $step1Label = 'Références de l\'adhérent';
    public $step2Label = 'État civil';
    public $step3Label = 'Informations personnelles';
    public $step4Label = 'Formations professionnelles';

    // Variables pour le personnel retraité
    public $grade, $departARetraite, $numeroCARFO;

    public $nombreAyantsDroits = 0;
    public $ayantsDroits = [];

    use WithFileUploads; 

    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl; // Mettez à jour l'URL de l'image
    }

    // Méthode pour mettre à jour les champs selon le statut
    public function updatedStatut($value)
    {
        if ($value === 'personnel_retraite') {
            // Réinitialiser les propriétés pour le personnel retraité
            $this->grade = null;
            $this->departARetraite = null;
            $this->numeroCARFO = null;
            // Réinitialiser les champs du personnel en activité
            $this->dateIntegration = null;
            $this->dateDepartARetraite = null;
            $this->direction = null;
            $this->service = null;
        } elseif ($value === 'personnel_active') {
            // Réinitialiser les propriétés pour le personnel en activité
            $this->dateIntegration = null;
            $this->dateDepartARetraite = null;
            $this->direction = null;
            $this->service = null;
            // Réinitialiser les champs du personnel retraité
            $this->grade = null;
            $this->departARetraite = null;
            $this->numeroCARFO = null;
        }
    }

    public function updatedNombreAyantsDroits()
    {
        if ($this->nombreAyantsDroits > 0) {
            $this->ayantsDroits = array_fill(0, $this->nombreAyantsDroits, [
                'nom' => '',
                'prenom' => '',
                'sexe' => '',
                'date_naissance' => '',
                'lien_parenté' => ''
            ]);
        } else {
            $this->ayantsDroits = []; // Réinitialise si le nombre est 0
        }
    }


    // Méthode pour passer à l'étape suivante
    public function nextStep()
    {
        $this->validateStep(); // Valider l'étape avant de passer à la suivante

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    // Méthode pour revenir à l'étape précédente
    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    // Méthode de validation par étape
    public function validateStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'matricule' => 'required|min:3',
                'nip' => 'required',
                'cnib' => 'required',
                'delivree' => 'required|date',
                'expire' => 'required|date|after:delivree', // Assurez-vous que 'expire' est après 'delivree'
                'adresse_permanente' => 'required',
                'telephone' => 'required',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'genre' => 'required',
                'departement' => 'required|string',
                'ville' => 'required|string',
                'pays' => 'nullable|string',
                'nom_pere' => 'required|string',
                'nom_mere' => 'required|string',
            ]);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'situation_matrimoniale' => 'required|string',
                'nom_prenom_personne_besoin' => 'required|string|max:255',
                'lieu_residence' => 'required|string|max:255',
                'telephone' => 'required',
                'nombreAyantsDroits' => 'nullable|integer|min:0|max:6',
            ]);
    
            if ($this->nombreAyantsDroits > 0) {
                foreach ($this->ayantsDroits as $index => $ayantDroit) {
                    $this->validate([
                        "ayantsDroits.$index.nom" => 'required|string',
                        "ayantsDroits.$index.prenom" => 'required|string',
                        "ayantsDroits.$index.sexe" => 'required|string',
                        "ayantsDroits.$index.date_naissance" => 'required|date',
                        "ayantsDroits.$index.lien_parenté" => 'required',
                    ]);
                }
            }
        } elseif ($this->currentStep == 4) {
            $this->validate([
                'statut' => 'required', // Le statut doit être sélectionné
            ]);
        
            // Si l'utilisateur est un personnel retraité
            if ($this->statut === 'personnel_retraite') {
                $this->validate([
                    'grade' => 'required|string',
                    'departARetraite' => 'required|date',
                    'numeroCARFO' => 'required|string',
                ]);
            }
        
            // Si l'utilisateur est un personnel en activité
            if ($this->statut === 'personnel_active') {
                $this->validate([
                    'grade' => 'required|string',
                    'dateIntegration' => 'required|date',
                    'dateDepartARetraite' => 'required|date|after:dateIntegration', // La date de départ à la retraite doit être après l'intégration
                    'direction' => 'required|string',
                    'service' => 'required|string',
                ]);
            }
        }
    }

    // Méthode de soumission finale du wizard
    public function submit()
    {
        
        $this->validateStep(); // Valider la dernière étape

        $categorie = DemandeCategorieHelper::determineCategorie($this->nombreAyantsDroits);

        $data = [
            'matricule' => $this->matricule,
            'nip' => $this->nip,
            'cnib' => $this->cnib,
            'delivree' => $this->delivree,
            'expire' => $this->expire,
            'adresse' => $this->adresse_permanente,
            'telephone' => $this->telephone,
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
            'photo' => $this->imageUrl, 
            'nombreAyantsDroits' => $this->nombreAyantsDroits,
            'ayantsDroits' => json_encode($this->ayantsDroits),
            'categorie' => $categorie,
            'statut' => $this->statut,
            'grade' => $this->grade,
            'departARetraite' => $this->departARetraite,
            'numeroCARFO' => $this->numeroCARFO,
            'dateIntegration' => $this->dateIntegration,
            'dateDepartARetraite' => $this->dateDepartARetraite,
            'direction' => $this->direction,
            'service' => $this->service,
        ];
        
        
        $demandeAdhesion = DemandeAdhesion::create($data);
        
        session()->flash('message', 'Formulaire soumis avec succès !');
        
        // Réinitialisez le formulaire si nécessaire
        $this->reset();
        $this->currentStep = 1; // Recommencer au début si souhaité
        
        // Redirection vers la vue souhaitée
        return redirect()->route('resume-adhesion', ['id' => $demandeAdhesion->id]);
    }

    public function updateExpire()
    {
        if ($this->delivree) {
            $delivreeDate = \Carbon\Carbon::parse($this->delivree);
            $this->expire = $delivreeDate->addYears(10)->toDateString(); 
        }
    }

    public function changeNombreAyantsDroits($value)
    {
        $this->nombreAyantsDroits = (int)$value;

        // Réinitialiser le tableau des ayants droits si le nombre change
        if ($this->nombreAyantsDroits > 0) {
            $this->ayantsDroits = array_fill(0, $this->nombreAyantsDroits, [
                'nom' => '',
                'prenom' => '',
                'sexe' => '',
                'date_naissance' => '',
                'lien_parenté' => '',
            ]);
        } else {
            $this->ayantsDroits = [];
        }
    }

    public function changeStatut($value)
    {
        $this->statut = $value;
    }

    public function render()
    {
        return view('livewire.wizard-membership');
    }
}
