<?php

namespace App\Livewire;

use App\Helpers\DemandeCategorieHelper;
use App\Models\DemandeAdhesion;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Adherent;

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
    // Select du grade
    public $grades = [
        "Commissaire de Police",
        "Commissaire Principale de Police",
        "Commissaire Divisionnaire de Police",
        "Contrôleur Général de Police",
        "Inspecteur Général de Police",
        "Sous-Lieutenant de Police",
        "Lieutenant de Police",
        "Capitaine de Police",
        "Commandant de Police",
        "Commandant Major de Police",
        "Sergent de Police",
        "Sergent-Chef de Police",
        "Adjudant de Police",
        "Adjudant-Chef de Police",
        "Adjudant-Chef Major de Police"
    ];

    // Variables pour le personnel retraité
    public $grade, $departARetraite, $numeroCARFO;

    public $nombreAyantsDroits;
    public $ayantsDroits = [];

    public  $signature, $signatureImage; 
    protected $listeners = ['signatureDataUpdated' => 'updateSignatureData'];


    // ------------------------------------------------------------------------------------------------
    public $adherentType;
    public $adherent;
    public $hasMatricule, $hasNip, $hasCnib, $hasAdressePermanente, $hasTelephone, $hasEmail;
    public $showConfirmationForm = false; // Contrôle l'affichage du formulaire de confirmation
    public $id;



    // Méthode pour passer à l'étape suivante
    public function mount()
    {
        $this->currentStep = session()->get('currentStep', 1);
    }

    public function changeAdherentType($type)
    {
        $this->adherentType = $type; // Logique pour changer le type d'adhérent
        $this->currentStep = 1;
    }

    public function checkExistingData()
    {
        // Vérifier si un adhérent existe avec les mêmes matricule, service et nombre d'ayants-droits
        $existingAdherent = Adherent::where('matricule', $this->matricule)
                                    ->where('service', $this->service)
                                    ->where('charge', $this->nombreAyantsDroits)
                                    ->where('charge', $this->nombreAyantsDroits)
                                    ->first();

        if ($existingAdherent) {

            $this->showConfirmationForm = true; // Afficher le formulaire

            $this->adherent = $existingAdherent;
            // dd($existingAdherent);

             // Remplir dynamiquement les propriétés Livewire à partir du modèle
            foreach ($existingAdherent->toArray() as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
            // Etape 1
            $this->nip = $existingAdherent->nip;
            $this->cnib = $existingAdherent->cnib;
            $this->delivree = $existingAdherent->delivree;
            $this->expire = $existingAdherent->expire;
            $this->adresse_permanente = $existingAdherent->adresse_permanente;
            $this->telephone = $existingAdherent->telephone;
            $this->email = $existingAdherent->email;

            // Etape 2
            $this->nom = $existingAdherent->nom;
            $this->prenom = $existingAdherent->prenom;
            $this->genre = $existingAdherent->genre;
            $this->departement = $existingAdherent->departement;
            $this->ville = $existingAdherent->ville;
            $this->pays = $existingAdherent->pays;
            $this->nom_pere = $existingAdherent->nom_pere;
            $this->nom_mere = $existingAdherent->nom_mere;

            // Etape 3
            $this->situation_matrimoniale = $existingAdherent->situation_matrimoniale;  // Situation matrimoniale
            $this->nom_prenom_personne_besoin = $existingAdherent->nom_prenom_personne_besoin;  // Personne à prévenir
            $this->lieu_residence = $existingAdherent->lieu_residence;
            $this->telephone_personne_prevenir = $existingAdherent->telephone_personne_prevenir;
            $this->photo = $existingAdherent->photo;
            //$this->nombreAyantsDroits = $existingAdherent->charge;
            
            // Etape 4

            $this->showConfirmationForm = true; // Masquer le formulaire
            
            session()->flash('error', 'Veuillez mettre à jour votre adhésion en remplissant tous les champs manquants.'); // Si un adhérent existe avec ces informations exactes, mettre à jour ou afficher un message d'erreur
            
        } else {
            // Si aucun adhérent n'existe avec ces informations exactes
            session()->flash('success', 'Informations inexactes. \nVeuillez revérifier les données saisies !');
        }
    }


    public function nextStep()
    {
        $this->validateStep(); // Valider l'étape avant de passer à la suivante

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
            session()->put('currentStep', $this->currentStep);
        }
    }

    
    // Méthode pour revenir à l'étape précédente
    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
            session()->put('currentStep', $this->currentStep);
        }
    }
    public function goToStep($step)
    {
        if ($step > $this->currentStep) {
            $this->validateStep(); // Valider avant de permettre la navigation vers une étape suivante
        }
        if ($step >= 1 && $step <= $this->totalSteps) {
            $this->currentStep = $step;
            session()->put('currentStep', $this->currentStep);
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
                'telephone' => [
                    'required',
                    'regex:/^(\+?[0-9]{1,3})?[0-9]{8,10}$/',
                ],
                'email' => 'required|email|unique:adherents,email,' . $this->id . '|unique:partenaires,email,' . $this->id,

            ],
            [
                'email.unique' => 'L\'email est  déjà utilisé',
                'telephone.required' => 'Numéro de téléphone requis.',
                'telephone.regex' => 'Numéro de téléphone invalide.',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'genre' => 'required',
                'departement' => 'required|string',
                'ville' => 'required|string',
                'pays' => 'required|string',
                'nom_pere' => 'required|string',
                'nom_mere' => 'required|string',
            ]);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'situation_matrimoniale' => 'required|string',
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:1024',
                'nom_prenom_personne_besoin' => 'required|string|max:255',
                'lieu_residence' => 'required|string|max:255',
                'telephone_personne_prevenir' => [
                    'required',
                    'regex:/^(\+?[0-9]{1,3})?[0-9]{8,10}$/',
                ],
                'nombreAyantsDroits' => 'required|integer',
            ],
            [
                'photo.required' => 'La photo est obligatoire.',
                'photo.image' => 'Le fichier téléchargé doit être une image.',
                'photo.mimes' => 'L\'image doit être de type jpeg, png ou jpg.',
                'photo.max' => 'La taille de l\'image ne doit pas dépasser 1 Mo.',
               

                'telephone_personne_prevenir.required' => 'Numéro de téléphone requis.',
                'telephone_personne_prevenir.regex' => 'Numéro de téléphone invalide.',

            ]);

            if ($this->photo) {
                // Vérification du type MIME
                $mimeType = $this->photo->getMimeType();
                if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/jpg'])) {
                    session()->flash('error', 'Le fichier doit être une image valide.');
                    return;
                }
                 // Générer un nom unique pour l'image (ne pas utiliser le nom original)
                $fileName = uniqid('photo_', true) . '.' . $this->photo->getClientOriginalExtension();

                $path = $this->photo->storeAs('public/photos/adherents', $fileName);
                $this->photo_path_adherent = 'photos/adherents/' . $fileName;
            }
        
            if ($this->nombreAyantsDroits > 0) {
                foreach ($this->ayantsDroits as $index => $ayantDroit) {
                    $this->validate([
                        "ayantsDroits.$index.nom" => 'required|string|max:255',
                        "ayantsDroits.$index.prenom" => 'required|string|max:255',
                        "ayantsDroits.$index.sexe" => 'required',
                        "ayantsDroits.$index.date_naissance" => 'required|date',
                        "ayantsDroits.$index.relation" => 'required|string|max:255',

                        "ayantsDroits.$index.photo" => 'nullable|image|max:1024',
                        "ayantsDroits.$index.cnib" => 'nullable|mimes:pdf|max:1024',
                        "ayantsDroits.$index.extrait" => 'nullable|mimes:pdf|max:1024',
                        
                    ]);
                    
                    if (isset($ayantDroit['photo'])) {
                        $photoName = uniqid() . '_' . $ayantDroit['photo']->getClientOriginalName();
                        $photoPath = $ayantDroit['photo']->storeAs('public/photos/ayants_droits', $photoName);
                        $this->ayantsDroits[$index]['photo_path'] = 'storage/photos/ayants_droits/' . $photoName;
                    }
            
                    if (isset($ayantDroit['cnib'])) {
                        $cnibName = uniqid() . '_' . $ayantDroit['cnib']->getClientOriginalName();
                        $cnibPath = $ayantDroit['cnib']->storeAs('public/pdf/cnibs', $cnibName);
                        $this->ayantsDroits[$index]['cnib_path'] = 'storage/pdf/cnibs/' . $cnibName;
                    }

                    if (isset($ayantDroit['extrait'])) {
                        $extraitName = uniqid() . '_' . $ayantDroit['extrait']->getClientOriginalName();
                        $extraitPath = $ayantDroit['extrait']->storeAs('public/pdf/extraits', $extraitName);
                        $this->ayantsDroits[$index]['extrait_path'] = 'storage/pdf/extraits/' . $extraitName;
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
        $this->validateStep(); // Assurez-vous de valider la dernière étape

        // Détermination de la catégorie une fois pour les deux cas
        $categorie = DemandeCategorieHelper::determineCategorie($this->nombreAyantsDroits);

        // Préparation des données communes
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

         // Si un adhérent existe déjà, on le met à jour, sinon on crée un nouvel enregistrement
        if ($this->adherent) {
            //$this->adherent->update($data);
            // Identifie l'ancien adhérent
            $ancienAdherentId = $this->adherent->id;

            $demandeAdhesion = DemandeAdhesion::create($data);

            // Supprime l'ancien adhérent
            $this->adherent->delete();

            session()->flash('message', 'La demande d\'adhésion a été mise à jour.');

        } else {
            // Si l'adhérent n'existe pas, on crée un nouvel adhérent et une nouvelle demande
            $demandeAdhesion = DemandeAdhesion::create($data);
            session()->flash('message', 'L\'adhérent et sa demande d\'adhésion ont été créés avec succès.');
        }

        // Réinitialisation et redirection
        $this->reset();
        $this->currentStep = 1;
        session()->put('currentStep', 1);
        // dd($demandeAdhesion->id);

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
                'relation' => '',
            ]);
        } else {
            $this->ayantsDroits = [];
        }
    }
    public function changeLienParente($value, $index)
    {
        $this->ayantsDroits[$index]['relation'] = $value;
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
