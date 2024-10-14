<?php

namespace App\Livewire;

use Livewire\Component;

class WizardMembership extends Component
{
    public $currentStep = 1; // Étape actuelle du wizard
    public $totalSteps = 4;   // Nombre total d'étapes  

    // Variables pour les données du formulaire
    public $matricule, $nip, $cnib, $delivree, $expire, $adresse, $telephone;
    public $email, $password, $nom, $prenom, $genre, $departement, $ville, $pays, $nom_pere, $nom_mere, $situation_matrimoniale;
    public $nom_prenom_personne_besoin, $lieu_residence, $telephone_personne_prevenir;
     // Propriétés pour les champs conditionnels
    // Variables pour le personnel en activité
    public $dateIntegration, $dateDepartARetraite, $direction, $service, $statut;



    // Variables pour le personnel retraité
    public $grade, $departARetraite, $numeroCARFO;

    public $nombreAyantsDroits = 0;
    public $ayantsDroits = [];
   

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
                'adresse' => 'required',
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
                        "ayantsDroits.$index.nom" => 'required|string|max:255',
                        "ayantsDroits.$index.prenom" => 'required|string|max:255',
                        "ayantsDroits.$index.sexe" => 'required|string|in:H,F',
                        "ayantsDroits.$index.date_naissance" => 'required|date',
                        "ayantsDroits.$index.lien_parenté" => 'required|string|max:255',
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

        // Logique pour enregistrer les données, par exemple :
        // User::create([
        //     'matricule' => $this->matricule,
        //     'nip' => $this->nip,
        //     'cnib' => $this->cnib,
        //     // Ajoutez les autres champs ici...
        // ]);

        session()->flash('message', 'Formulaire soumis avec succès !');
        
        // Réinitialisez le formulaire si nécessaire
        $this->reset();
        $this->currentStep = 1; // Recommencer au début si souhaité
        
        // Redirection vers la vue souhaitée
        return redirect()->route('accueil');
    }

    public function mount()
    {
        $this->ayantsDroits = [];
    }
    public function render()
    {
        return view('livewire.wizard-membership');
    }
}
