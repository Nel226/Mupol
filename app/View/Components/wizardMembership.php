<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WizardMembership extends Component
{
    public int $step; // Déclarez la propriété $step avec le type int
    public $totalSteps ;

    // Variables pour les données du formulaire
    public $matricule, $nip, $cnib, $delivree, $expire, $adresse_permanente, $telephone;
    public $email, $password, $nom, $prenom, $genre, $departement, $ville, $pays, $nom_pere, $nom_mere, $situation_matrimoniale;
    public $nom_prenom_personne_besoin, $lieu_residence, $telephone_personne_prevenir;
     // Propriétés pour les champs conditionnels
    // Variables pour le personnel en activité
    public $dateIntegration, $dateDepartARetraite, $direction, $service, $statut;

  

    // Variables pour le personnel retraité
    public $grade, $departARetraite, $numeroCARFO;

    public $nombreAyantsDroits = 0;
    public $ayantsDroits = [];
    public $data;


    /**
     * Create a new component instance.
     *
     * @param int $step
     */
    public function __construct(int $step = 1) // Ajoutez un paramètre au constructeur
    {
        $this->step = $step; // Initialisez la propriété
        $this->totalSteps = 5;
        $this->data = ''; // Initialisez la propriété

        
    }
    public function mount()
    {
        $this->matricule = ''; 
    }

    
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.wizard-membership', ['step' => $this->step, 'totalSteps' => $this->totalSteps]); // Passez $step à la vue
    }
}
