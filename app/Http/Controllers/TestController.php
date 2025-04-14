<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DemandeAdhesion;

class TestController extends Controller
{
    public function submit(Request $request)
    {
        // Log des données reçues
        Log::info('Données reçues :', $request->all());

        $nombreAyantsDroits = $request->input('nombreAyantsDroits', 0);


        // Identifier l'étape actuelle
        $currentStep = $request->input('currentStep');
        $rules = [];
        $messages = [];
        $validatedData = [];

        // Définir les règles et messages de validation pour chaque étape
        switch ($currentStep) {
            case 1: // Étape 1 : Informations personnelles
                $rules = [
                    'matricule' => 'required|string|max:255',
                    'nip' => 'required|string|max:255',
                    'cnib' => 'required|string|max:255',
                    'delivree' => 'required|date',
                    'expire' => 'nullable|date',
                    'adresse_permanente' => 'required|string|max:255',
                    // 'telephone' => 'required|regex:/^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$/',
                    'telephone' => 'required|numeric',
                    'email' => 'required|email|max:255',
                ];
                $messages = [
                    'matricule.required' => 'Le matricule est requis.',
                    'nip.required' => 'Le NIP est requis.',
                ];
                break;

            case 2: // Étape 2 : Détails supplémentaires
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
                $messages = [
                    'nom.required' => 'Le nom est requis.',
                    'prenom.required' => 'Le prénom est requis.',
                ];
                break;

            case 3: // Étape 3 : Contact d'urgence et documents
                $rules = [
                    'situation_matrimoniale' => 'required|string',
                    'nom_prenom_personne_besoin' => 'required|string|max:255',
                    'lieu_residence' => 'required|string|max:255',
                    'telephone_personne_prevenir' => 'required|regex:/^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$/',
                    // 'photo' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                ];
                $messages = [
                    'lieu_residence.required' => 'Le lieu de résidence est requis.',
                    'telephone_personne_prevenir.required' => 'Le téléphone est requis.',
                    'telephone_personne_prevenir.regex' => 'Le numéro de téléphone n\'est pas valide.',
                ];
                break;

            case 4: // Étape 4 : Situation matrimoniale et Ayants-droits
                $rules = [
                    'situation_matrimoniale' => 'required|string|in:Célibataire,Marié(e),Divorcé(e),Veuf(ve)',
                    'nom_prenom_personne_besoin' => 'required|string|max:255',
                    'lieu_residence' => 'required|string|max:255',
                    'telephone_personne_prevenir' => 'required|regex:/^(\+?[1-9][0-9]{0,2})?[0-9]{8,10}$/',
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                    'nombreAyantsDroits' => 'required|integer|min:0|max:6',
                ];

                // Validation dynamique des ayants droits
                $nombreAyantsDroits = $request->input('nombreAyantsDroits');
                if ($nombreAyantsDroits > 0) {
                    // Validation dynamique des ayants droits
                    for ($i = 0; $i < $nombreAyantsDroits; $i++) {
                        $rules["ayantsDroits.$i.nom"] = 'required|string|max:255';
                        $rules["ayantsDroits.$i.prenom"] = 'required|string|max:255';
                        $rules["ayantsDroits.$i.sexe"] = 'required|in:M,F';
                        $rules["ayantsDroits.$i.date_naissance"] = 'required|date';
                        $rules["ayantsDroits.$i.relation"] = 'required|in:conjoint,enfant';
                
                        // Validation spécifique pour CNIB si le lien de parenté est "conjoint"
                        $rules["ayantsDroits.$i.cnib"] = ($request->input("ayantsDroits.$i.relation") === 'conjoint') ? 'nullable|file|mimes:pdf|max:2048' : 'nullable';
                        
                        // Validation photo et extrait d'acte de naissance
                        $rules["ayantsDroits.$i.photo"] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
                        $rules["ayantsDroits.$i.extrait"] = 'nullable|file|mimes:pdf|max:2048';
                    }
                }

                $messages = [
                    'situation_matrimoniale.required' => 'La situation matrimoniale est obligatoire.',
                    'nom_prenom_personne_besoin.required' => 'Le nom et prénom de la personne à prévenir sont obligatoires.',
                ];
                break;
            case 5:
                $rules = [
                    
                ];
                $messages = [];
                break;

            default: // Étape inconnue
                return response()->json(['error' => 'Étape inconnue'], 400);
        }

        // Validation des données
        $validator = Validator::make($request->all(), $rules, $messages);
        $validatedData['adresse'] = $request->input('adresse_permanente');

        // Gestion des erreurs de validation
        if ($validator->fails()) {
            Log::error('Erreur de validation :', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        

        // Gestion des fichiers (si présents)
        if ($request->hasFile('photo')) {
            // Générer un nom unique pour la photo
            $photoName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            
            // Définir le chemin où vous souhaitez stocker le fichier
            $photoPath = $request->file('photo')->storeAs('public/photos/adherents', $photoName);
        
            Log::info('Photo sauvegardée : ' . $photoPath);
        
            // Sauvegarder le chemin du fichier dans les données validées
            $validatedData['photo'] = 'photos/adherents/' . $photoName;
        }

        // Gestion des fichiers des ayants droits
        if ($nombreAyantsDroits > 0) {
            for ($i = 0; $i < $nombreAyantsDroits; $i++) {
                // Photo des ayants droits
                if ($request->hasFile("ayantsDroits.$i.photo")) {
                    $photoName = uniqid() . '.' . $request->file("ayantsDroits.$i.photo")->getClientOriginalExtension();
                    $photoPath = $request->file("ayantsDroits.$i.photo")->storeAs('public/photos/ayants_droits', $photoName);
                    $validatedData["ayantsDroits.$i.photo"] = 'photos/ayants_droits/' . $photoName;
                    Log::info("Photo de l'ayant droit $i sauvegardée : " . $photoPath);
                }

                // CNIB des ayants droits
                if ($request->hasFile("ayantsDroits.$i.cnib")) {
                    $cnibName = uniqid() . '.' . $request->file("ayantsDroits.$i.cnib")->getClientOriginalExtension();
                    $cnibPath = $request->file("ayantsDroits.$i.cnib")->storeAs('public/pdf/cnibs', $cnibName);
                    $validatedData["ayantsDroits.$i.cnib"] = 'pdf/cnibs/' . $cnibName;
                    Log::info("CNIB de l'ayant droit $i sauvegardé : " . $cnibPath);
                }

                // Extrait des ayants droits
                if ($request->hasFile("ayantsDroits.$i.extrait")) {
                    $extraitName = uniqid() . '.' . $request->file("ayantsDroits.$i.extrait")->getClientOriginalExtension();
                    $extraitPath = $request->file("ayantsDroits.$i.extrait")->storeAs('public/pdf/extraits', $extraitName);
                    $validatedData["ayantsDroits.$i.extrait"] = 'pdf/extraits/' . $extraitName;
                    Log::info("Extrait de l'ayant droit $i sauvegardé : " . $extraitPath);
                }
            }
        }


        // Données validées
        $validatedData = $validator->validated();

        // Créer une nouvelle demande d'adhésion
        //$demandeAdhesion = DemandeAdhesion::create($validatedData);

            // Réinitialisation et redirection
        //$this->reset();  // Assurez-vous que `reset()` réinitialise le formulaire
        $currentStep = 1;
        session()->put('currentStep', 1);
        // Stockage ou traitement des données validées
        Log::info('Données validées :', $validatedData);


        //return redirect()->route('resume-adhesion', ['id' => $demandeAdhesion->id]);
        return response()->json(['success' => true, 'data' => $validatedData]);
    }
}
