<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\DemandeCategorieHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\DemandeAdhesion;

class MembershipController extends Controller
{
    public function submit(Request $request)
{
    // Log des données reçues
    Log::info('Données reçues :', $request->all());

    // Récupérer toutes les données de la requête
    $data = $request->all();
    $nombreAyantsDroits = $request->input('nombreAyantsDroits', 0);
    $currentStep = $request->input('currentStep');
    $rules = [];
    $messages = [];
    $validatedData = [];

    // Décoder les ayantsDroits si c'est une chaîne JSON
    $ayantsDroits = $request->input('ayantsDroits');
    if (is_string($ayantsDroits)) {
        $ayantsDroits = json_decode($ayantsDroits, true);
    }

    // Étape 1 : Informations personnelles
    if ($currentStep == 1) {
        $rules = [
            'matricule' => 'required|integer|unique:adherents,matricule',
            'nip' => 'required|string|max:255',
            'cnib' => 'required|string|max:255',
            'delivree' => 'required|date',
            'expire' => 'required|date',
            'adresse_permanente' => 'required|string|max:255',
            'telephone' => 'required|numeric',
            'email' => 'required|email|max:255|unique:adherents,email',

        ];
        $messages = [
            'matricule.required' => 'Le matricule est requis.',
            'nip.required' => 'Le NIP est requis.',
            'email.unique' => 'Cet email est déjà utilisé. Veuillez en choisir un autre.',
            'matricule.unique' => 'Matricule déjà inscrit.',


        ];

    }
    // Étape 2 : Détails supplémentaires
    elseif ($currentStep == 2) {
        $rules = [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'genre' => 'required|string|max:10',
            'departement' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'nom_pere' => 'required|string|max:255',
            'nom_mere' => 'required|string|max:255',
        ];
        
    }
    // Étape 3 : Contact d'urgence et documents
    elseif ($currentStep == 3) {
        $rules = [
            'situation_matrimoniale' => 'required|string',
            'nom_prenom_personne_besoin' => 'required|string|max:255',
            'lieu_residence' => 'required|string|max:255',
            'telephone_personne_prevenir' => 'required|regex:/^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$/',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nombreAyantsDroits' => 'required|integer|min:0|max:6',
            'signature' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ];

        if ($nombreAyantsDroits > 0) {
            foreach ($request->input('ayantsDroits', []) as $i => $ayantDroit) {
                $rules["ayantsDroits.$i.nom"] = 'required|string|max:255';
                $rules["ayantsDroits.$i.prenom"] = 'required|string|max:255';
                $rules["ayantsDroits.$i.sexe"] = 'required|in:M,F';
                $rules["ayantsDroits.$i.date_naissance"] = 'required|date';
                $rules["ayantsDroits.$i.relation"] = 'required';
                $rules["ayantsDroits.$i.cnib"] = ($ayantDroit['relation'] === 'Conjoint(e)') 
                    ? 'required|file|mimes:pdf|max:2048' 
                    : 'nullable|file|mimes:pdf|max:2048';
                $rules["ayantsDroits.$i.photo"] = 'required|image|mimes:jpeg,png,jpg|max:2048';
                
                $rules["ayantsDroits.$i.extrait"] = 'required|file|mimes:pdf|max:2048';
            }
        }

        // Définition des messages personnalisés
        $messages = [
            'photo.max' => 'La taille de la photo ne doit pas dépasser 2 Mo.',
            'ayantsDroits.*.photo.max' => 'La taille de la photo de l\'ayant droit ne doit pas dépasser 2 Mo.',
            'signature.max' => 'La taille de la photo de la signature ne doit pas dépasser 2 Mo.',

            'ayantsDroits.*.extrait.max' => 'La taille de l\'extrait d\'acte de naissance ne doit pas dépasser 2 Mo.',
            'ayantsDroits.*.cnib.max' => 'La taille du fichier CNIB ne doit pas dépasser 2 Mo.',
        ];

    }
    // Étape 4 : Situation matrimoniale et Ayants-droits
    elseif ($currentStep == 4) {
        $rules = [
            'statut' => 'required',
            'region' => 'required',
            'province' => 'required',
            'localite' => 'required',

        ];

        if ($request->statut === 'Retraité(e)') {
            $rules['grade'] = 'required|string|max:255';
            $rules['departARetraite'] = 'required|date';
            $rules['numeroCARFO'] = 'required|string|max:255';
        } elseif ($request->statut === 'Actif(ve)') {
            $rules['grade'] = 'required|string|max:255';
            $rules['dateIntegration'] = 'required|date';
            $rules['dateDepartARetraite'] = 'required|date|after_or_equal:dateIntegration';
            $rules['direction'] = 'required|string|max:255';
            $rules['service'] = 'required|string|max:255';
        }

        // Validation des données
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            Log::error('Erreur de validation :', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return response()->json([
            'success' => true,
            'view' => $this->recapt($request) // Retourner la vue générée par la méthode recapt
        ]);
        

    }
    // Étape 5 : Ajouter les données à validatedData et créer la demande
    elseif ($currentStep == 5) {
        $validatedData = [];

        // Fonction pour gérer l'upload et lever une erreur si un fichier obligatoire est manquant
        function uploadFile($file, $directory, $required = false)
        {
            if ($file) {
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs("public/$directory", $fileName);
                return "$directory/$fileName";
            } elseif ($required) {
                throw new \Exception("Le fichier dans '$directory' est obligatoire mais n'a pas été fourni.");
            }
            return null; // Retourne null si le fichier est optionnel et non fourni
        }

        // Gestion des fichiers du demandeur
        $validatedData['photo'] = uploadFile($request->file('photo'), 'adherents/photos', true);
        $validatedData['signature'] = uploadFile($request->file('signature'), 'adherents/signatures', true);

        // Gestion des fichiers des ayants droits
        $nombreAyantsDroits = $request->input('nombreAyantsDroits', 0);
        if ($nombreAyantsDroits > 0) {
            for ($i = 0; $i < $nombreAyantsDroits; $i++) {
                $validatedData["ayantsDroits.$i.photo"] = uploadFile(
                    $request->file("ayantsDroits.$i.photo"),
                    'ayants_droits/photos',
                    true
                );
                $validatedData["ayantsDroits.$i.cnib"] = uploadFile(
                    $request->file("ayantsDroits.$i.cnib"),
                    'ayants_droits/cnibs'
                );
                $validatedData["ayantsDroits.$i.extrait"] = uploadFile(
                    $request->file("ayantsDroits.$i.extrait"),
                    'ayants_droits/extraits'
                );
            }
        }

        // Fusion des données avec celles validées
        $data = $request->all();
        foreach ($validatedData as $key => $value) {
            if ($value) {
                if (strpos($key, 'ayantsDroits') === 0) {
                    preg_match('/ayantsDroits\.(\d+)/', $key, $matches);
                    $index = $matches[1] ?? null;
                    if ($index !== null && isset($data["ayantsDroits"][$index])) {
                        $data["ayantsDroits"][$index][$key] = $value;
                    }
                } else {
                    $data[$key] = $value;
                }
            }
        }

        // Vérification et transformation des ayants droits en JSON
        if (isset($data['ayantsDroits'])) {
            $data['ayantsDroits'] = json_encode($data['ayantsDroits']);
        }

        // Ajout des informations supplémentaires
        $data['adresse'] = $data['adresse_permanente'] ?? 'Adresse non spécifiée';
        $data['is_new'] = true;
        $data['categorie'] = DemandeCategorieHelper::determineCategorie($nombreAyantsDroits);
        $data['code_carte'] = $data['matricule'] . '/00';

        // Création de la demande d'adhésion
        $demandeAdhesion = DemandeAdhesion::create($data);
        Log::info('Demande d\'adhésion créée avec succès', ['demande' => $demandeAdhesion]);

        return response()->json([
            'success' => true,
            'message' => 'Demande d\'adhésion créée avec succès.',
            'redirect_url' => route('finalisation-adhesion', ['id' => $demandeAdhesion->id])
        ]);
    }

    // Si aucune étape n'est valide
    else {
        return response()->json(['error' => 'Étape inconnue'], 400);
    }

    // Validation des données
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
        Log::error('Erreur de validation :', $validator->errors()->toArray());
        return response()->json(['errors' => $validator->errors()], 422);
    }
    // Si la validation réussit, ajouter les données validées
    $validatedData = array_merge($validatedData, $request->only(array_keys($rules)));
    Log::info("Données ajoutées pour l'étape :", $validatedData);

    Log::info('Données validées :', $validatedData);
    return response()->json(['success' => true, 'data' => $validatedData]);
}


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
public function recapt(Request $request)
{
    try {
        $data = $request->all();
        Log::info('Données recapt :', $data);

        // Assurez-vous que la vue est correctement retournée
        return response()->json([
            'success' => true,
            'view' => view('components.formulaire-adhesion', ['data' => $data])->render(),
        ]);
    } catch (\Exception $e) {
        // Log l'erreur et retourner un message d'erreur JSON
        Log::error('Erreur dans recapt :', ['exception' => $e->getMessage()]);
        return response()->json([
            'success' => false,
            'message' => 'Une erreur est survenue lors de la récupération des données.',
        ], 500);
    }
}


}


