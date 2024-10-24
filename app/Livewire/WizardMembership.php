<?php

namespace App\Livewire;

use App\Helpers\DemandeCategorieHelper;
use App\Models\DemandeAdhesion;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class WizardMembership extends Component
{
    use WithFileUploads; 


    public $currentStep = 1; // Étape actuelle du wizard
    public $totalSteps = 5;   // Nombre total d'étapes  

    // Variables pour les données du formulaire
    public $matricule, $nip, $cnib, $delivree, $expire, $adresse_permanente, $telephone, $email;
    public  $nom, $prenom, $genre, $departement, $ville, $pays, $nom_pere, $nom_mere, $situation_matrimoniale;
    // Variables info personnnelles
    public $nom_prenom_personne_besoin, $lieu_residence, $telephone_personne_prevenir, $photo, $photo_path_adherent, $photo_path_ayantdroit; 
    // Variables pour le personnel en activité
    public $dateIntegration, $dateDepartARetraite, $direction, $service, $statut;

  

    // Variables pour le personnel retraité
    public $grade, $departARetraite, $numeroCARFO;

    public $nombreAyantsDroits;
    public $ayantsDroits = [];

    public  $signature, $signatureImage; 
    protected $listeners = ['signatureDataUpdated' => 'updateSignatureData'];

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
                'email' => 'required|email',

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
                'photo' => 'required|image|max:1024',
                'nom_prenom_personne_besoin' => 'required|string|max:255',
                'lieu_residence' => 'required|string|max:255',
                'telephone' => 'required',
                'nombreAyantsDroits' => 'required|integer',
            ]);

            if ($this->photo) {
                $path = $this->photo->storeAs('public/photos/adherents', $this->photo->getClientOriginalName());
                $this->photo_path_adherent = 'photos/adherents/' . $this->photo->getClientOriginalName();
            }
        
            if ($this->nombreAyantsDroits > 0) {
                foreach ($this->ayantsDroits as $index => $ayantDroit) {
                    $this->validate([
                        "ayantsDroits.$index.nom" => 'required|string|max:255',
                        "ayantsDroits.$index.prenom" => 'required|string|max:255',
                        "ayantsDroits.$index.sexe" => 'required',
                        "ayantsDroits.$index.date_naissance" => 'required|date',
                        "ayantsDroits.$index.lien_parente" => 'required|string|max:255',
                        // "ayantsDroits.$index.photo" => 'required|image|max:1024',
                        // "ayantsDroits.$index.cnib" => 'required|image|max:1024',
                        // "ayantsDroits.$index.extrait" => 'required|image|max:1024',


                    ]);
                    
                    if (isset($ayantDroit['photo'])) {
                        $path = $ayantDroit['photo']->storeAs('public/photos/ayants_droits', $ayantDroit['photo']->getClientOriginalName());
                        $this->photo_path_ayantdroit = 'photos/ayants_droits/' . $ayantDroit['photo']->getClientOriginalName();
                    }

                }
            }
            
            
        } elseif ($this->currentStep == 4) {
            $this->validate([
                'statut' => 'required', 
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
        
        $this->validateStep(); 

        $categorie = DemandeCategorieHelper::determineCategorie($this->nombreAyantsDroits);

        $data = [
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
            'photo' => $this->photo_path_adherent, 
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
        // $this->reset();
        

        $this->currentStep = 1; 
        
        return redirect()->route('resume-adhesion', ['id' => $demandeAdhesion->id]);
    }
    
    public function saveSignature()
    {
        if ($this->signature) {
            // Supprimer la partie avant les données base64
            $signatureData = str_replace('data:image/png;base64,', '', $this->signature);
            $signatureData = str_replace(' ', '+', $signatureData); // Gérer les espaces
            $decodedData = base64_decode($signatureData);
        
            // Définir le chemin où vous souhaitez enregistrer la signature
            $fileName = uniqid() . '.png'; // Nom de fichier unique
            $filePath = 'signatures/' . $fileName; // Chemin relatif dans le dossier storage/app/signatures
            
            // Enregistrer l'image décodée dans le storage
            Storage::put($filePath, $decodedData);
            
            // Stocker le chemin relatif dans la variable signature_path
            $this->signatureImage = $filePath;

            session()->flash('message', 'Signature enregistrée avec succès.');
        } else {
            session()->flash('error', 'Aucune signature à enregistrer.');
        }
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
                'lien_parente' => '',
            ]);
        } else {
            $this->ayantsDroits = [];
        }
    }
    public function changeLienParente($value, $index)
    {
        $this->ayantsDroits[$index]['lien_parente'] = $value;
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
