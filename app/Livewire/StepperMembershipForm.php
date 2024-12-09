<?php

namespace App\Livewire;

use Livewire\Component;

class StepperMembershipForm extends Component
{
    public $currentStep = 1;
    public $totalSteps = 5;


    // Méthode pour passer à l'étape suivante
    public function nextStep()
    {
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


    // Méthode pour naviguer vers une étape spécifique
    public function goToStep($step)
    {
        $this->currentStep = $step;
    }
    
    public function render()
    {
        return view('livewire.stepper-membership-form');
    }
}
