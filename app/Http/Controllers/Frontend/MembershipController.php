<?php

namespace App\Http\Controllers\Frontend;

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
            'matricule' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'cnib' => 'required|string|max:255',
            'delivree' => 'required|date',
            'expire' => 'nullable|date',
            'adresse_permanente' => 'required|string|max:255',
            'telephone' => 'required|numeric',
            'email' => 'required|email|max:255',
        ];
        $messages = [
            'matricule.required' => 'Le matricule est requis.',
            'nip.required' => 'Le NIP est requis.',
        ];

    }
    // Étape 2 : Détails supplémentaires
    elseif ($currentStep == 2) {
        $rules = [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
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
        ];

        if ($nombreAyantsDroits > 0) {
            foreach ($request->input('ayantsDroits', []) as $i => $ayantDroit) {
                $rules["ayantsDroits.$i.nom"] = 'required|string|max:255';
                $rules["ayantsDroits.$i.prenom"] = 'required|string|max:255';
                $rules["ayantsDroits.$i.sexe"] = 'required|in:M,F';
                $rules["ayantsDroits.$i.date_naissance"] = 'required|date';
                $rules["ayantsDroits.$i.relation"] = 'required|in:conjoint,enfant';
                $rules["ayantsDroits.$i.cnib"] = ($ayantDroit['relation'] === 'conjoint') ? 'nullable|file|mimes:pdf|max:2048' : 'nullable';
                $rules["ayantsDroits.$i.photo"] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
                $rules["ayantsDroits.$i.extrait"] = 'nullable|file|mimes:pdf|max:2048';
            }
        }

    }
    // Étape 4 : Situation matrimoniale et Ayants-droits
    elseif ($currentStep == 4) {
        $rules = [
            'statut' => 'required|in:personnel_retraite,personnel_active',
            'grade' => 'required|string|max:255',
        ];

        if ($request->statut === 'personnel_retraite') {
            $rules['departARetraite'] = 'required|date';
            $rules['numeroCARFO'] = 'required|string|max:255';
        } elseif ($request->statut === 'personnel_active') {
            $rules['dateIntegration'] = 'required|date';
            $rules['dateDepartARetraite'] = 'required|date|after_or_equal:dateIntegration';
            $rules['direction'] = 'required|string|max:255';
            $rules['service'] = 'required|string|max:255';
        }

    }
    // Étape 5 : Ajouter les données à validatedData et créer la demande
    elseif ($currentStep == 5) {
        // $rules = [
        //     'prenomEtape5' => 'required|string|max:255',
        // ];

        if ($request->hasFile('photo')) {
            $photoName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $photoPath = $request->file('photo')->storeAs('public/photos/adherents', $photoName);
            $validatedData['photo'] = 'photos/adherents/' . $photoName;
        }

        if ($nombreAyantsDroits > 0) {
            for ($i = 0; $i < $nombreAyantsDroits; $i++) {
                // Sauvegarder les fichiers des ayants droits
                if ($request->hasFile("ayantsDroits.$i.photo")) {
                    $photoName = uniqid() . '.' . $request->file("ayantsDroits.$i.photo")->getClientOriginalExtension();
                    $photoPath = $request->file("ayantsDroits.$i.photo")->storeAs('public/photos/ayants_droits', $photoName);
                    $validatedData["ayantsDroits.$i.photo"] = 'photos/ayants_droits/' . $photoName;
                }
    
                if ($request->hasFile("ayantsDroits.$i.cnib")) {
                    $cnibName = uniqid() . '.' . $request->file("ayantsDroits.$i.cnib")->getClientOriginalExtension();
                    $cnibPath = $request->file("ayantsDroits.$i.cnib")->storeAs('public/pdf/cnibs', $cnibName);
                    $validatedData["ayantsDroits.$i.cnib"] = 'pdf/cnibs/' . $cnibName;
                }
    
                if ($request->hasFile("ayantsDroits.$i.extrait")) {
                    $extraitName = uniqid() . '.' . $request->file("ayantsDroits.$i.extrait")->getClientOriginalExtension();
                    $extraitPath = $request->file("ayantsDroits.$i.extrait")->storeAs('public/pdf/extraits', $extraitName);
                    $validatedData["ayantsDroits.$i.extrait"] = 'pdf/extraits/' . $extraitName;
                }
            }
        }

        // Mettre à jour les données avec celles de validatedData
        $data = $request->all();
        foreach ($validatedData as $key => $value) {
            // Vérifier si la clé concerne un ayant droit (exemple: "ayantsDroits.0.nom")
            if (strpos($key, 'ayantsDroits') === 0) {
                // Identifier l'index de l'ayant droit
                preg_match('/ayantsDroits\.(\d+)/', $key, $matches);
                $index = isset($matches[1]) ? $matches[1] : null;
        
                if ($index !== null && isset($data["ayantsDroits"][$index])) {
                    // Si l'attribut de l'ayant droit existe, on remplace la valeur avec celle validée
                    $data["ayantsDroits"][$index][$key] = $value;
                }
            } 
            // Pour les autres données qui ne sont pas liées aux ayants droits
            elseif (isset($data[$key])) {
                $data[$key] = $value; // Remplacer la valeur par celle validée
            }
        }
        
        
        Log:info('Données traitées :', $data);
        // Vérifier si le token est présent dans les données
        if (isset($data['_token'])) {
            // Convertir le tableau d'ayants droits en une chaîne JSON
            if (isset($data['ayantsDroits'])) {
                $data['ayantsDroits'] = json_encode($data['ayantsDroits']);
            }

            // Ajoutez l'adresse si elle est disponible
            if (isset($data['adresse_permanente'])) {
                $data['adresse'] = $data['adresse_permanente'];
            } else {
                $data['adresse'] = 'Adresse non spécifiée';
            }

            // Ajouter la clé 'is_new' avant de créer la demande d'adhésion
            $data['is_new'] = true;

            Log::info('toutes les données', $validatedData);

            $demandeAdhesion = DemandeAdhesion::create($data);

            // Ajouter un log indiquant que la demande a été créée avec succès
            Log::info('Demande d\'adhésion créée :', ['demande' => $demandeAdhesion]);

            // Retourner une réponse JSON avec l'URL de redirection
            return response()->json([
                'success' => true,
                'message' => 'Demande d\'adhésion créée avec succès.',
                'redirect_url' => route('resume-adhesion', ['id' => $demandeAdhesion->id])
            ]);

        }

        
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

}
