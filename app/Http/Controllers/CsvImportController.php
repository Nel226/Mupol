<?php

namespace App\Http\Controllers;

use App\Models\Adherant;
use App\Models\AyantDroit;
use App\Imports\AdherantsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CsvImportController extends Controller
{
    public function import(Request $request)
    {
        // Validation du fichier
        $validator = Validator::make($request->all(), [
            'excel-file' => 'required|mimes:xlsx'
        ]);

        // Si la validation échoue, retourner avec les erreurs
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $header = [
            'ordre',
            'date_enregistrement',
            'nom',
            'prenom',
            'genre',
            'service',
            'no_matricule',
            'code_carte',
            'telephone',
            'charge',
            'mensualite',
            'adhesion'
        ];

        $headerAyantDroit = [
            'nom', 'prenom', 'sexe', 'date_naissance', 'relation', 'code', 'matricule_id'
        ];

        $file = $request->file('excel-file');

        try {
            // Importer les données depuis le fichier Excel
            Excel::import(new AdherantsImport, $file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            Log::error('Erreur de validation : ' . $e->getMessage());
            $failures = $e->failures();
            $messages = [];

            // Collecter les messages d'erreur
            foreach ($failures as $failure) {
                $messages[] = 'Erreur à la ligne ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }

            // Retourner avec les messages d'erreur
            return back()->withErrors($messages)->withInput();
        } catch (\Exception $e) {
             Log::error('Erreur générale lors de l\'importation : ' . $e->getMessage());
            // En cas d'erreur générale
            return back()->withErrors(['Erreur lors de l\'importation : ' . $e->getMessage()]);
        }

        $adherants = Adherant::all();
        $ayantsDroit = AyantDroit::all();

        return redirect()->route('adherants.index')
                         ->with('header', $header)
                         ->with('headerAyantDroit', $headerAyantDroit);
    }
}
