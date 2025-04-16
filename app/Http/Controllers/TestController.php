<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function submit(Request $request)
    {
        Log::info('Données reçues :', $request->all());

        $currentStep = $request->input('current_step');
        $rules = [];

        switch ($currentStep) {
            case 1:
                $rules = [
                    'matricule' => 'required|string|max:5',
                ];
                break;
            case 2:
                $rules = [
                    'nom' => 'required|string',
                ];
                break;
            case 3:
                $rules = [
                    'photo' => 'nullable|image|mimes:png,jpg|max:2048',
                ];
                break;
            case 4:
                $rules = [
                    'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                    'nombreAyantsDroits' => 'required|integer|min:0|max:6',
                    'ayantsDroits' => 'nullable|array',
                ];

                if ($request->input('nombreAyantsDroits', 0) > 0) {
                    $rules = array_merge($rules, [
                        'ayantsDroits.*.nom' => 'required|string|max:255',
                        'ayantsDroits.*.prenom' => 'required|string|max:255',
                        'ayantsDroits.*.sexe' => 'required|in:M,F',
                        'ayantsDroits.*.date_naissance' => 'required|date',
                        'ayantsDroits.*.relation' => 'required|in:conjoint,enfant',
                        'ayantsDroits.*.photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                        'ayantsDroits.*.cnib' => 'nullable|file|mimes:pdf|max:2048',
                        'ayantsDroits.*.extrait' => 'nullable|file|mimes:pdf|max:2048',
                    ]);
                }
                break;
            default:
                return response()->json([
                    'error' => 'Étape inconnue. Étapes valides : 1, 2, 3, 4.'
                ], 400);
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::error('Erreur de validation :', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();
        $filePaths = [];

        // Sauvegarde de la photo principale
        if ($request->hasFile('photo')) {
            $filePaths['photo'] = $request->file('photo')->store('uploads', 'public');
            Log::info('Photo sauvegardée : ' . $filePaths['photo']);
        }

        // Traitement des fichiers des ayants droits
        if ($request->has('ayantsDroits')) {
            foreach ($request->file('ayantsDroits', []) as $index => $files) {
                if (isset($files['photo'])) {
                    $filePaths["ayantsDroits.$index.photo"] = $files['photo']->store('uploads', 'public');
                    Log::info("Photo Ayant Droit $index sauvegardée : " . $filePaths["ayantsDroits.$index.photo"]);
                }
                if (isset($files['cnib'])) {
                    $filePaths["ayantsDroits.$index.cnib"] = $files['cnib']->store('uploads', 'public');
                    Log::info("CNIB Ayant Droit $index sauvegardée : " . $filePaths["ayantsDroits.$index.cnib"]);
                }
                if (isset($files['extrait'])) {
                    $filePaths["ayantsDroits.$index.extrait"] = $files['extrait']->store('uploads', 'public');
                    Log::info("Extrait Ayant Droit $index sauvegardée : " . $filePaths["ayantsDroits.$index.extrait"]);
                }
            }
        }

        return response()->json(['success' => true, 'data' => $validatedData]);
    }
}
