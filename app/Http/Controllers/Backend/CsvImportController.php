<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Adherent;
use App\Models\AyantDroit;
use App\Imports\AdherentsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CsvImportController extends Controller
{
    public function import(Request $request)
    {
        Log::info('Début de l\'importation du fichier Excel.');

        // Validation du fichier
        $validator = Validator::make($request->all(), [
            'excel-file' => 'required|mimes:xlsx'
        ]);

        if ($validator->fails()) {
            Log::warning('Validation échouée pour le fichier Excel.', ['errors' => $validator->errors()->all()]);
            return back()->withErrors($validator)->withInput();
        }

        Log::info('Validation du fichier Excel réussie.');

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
            Log::info('Début de l\'importation des données Excel.');
            Excel::import(new AdherentsImport, $file);
            Log::info('Importation des données Excel terminée avec succès.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            Log::error('Erreur de validation lors de l\'importation.', ['exception' => $e->getMessage()]);
            $failures = $e->failures();
            $messages = [];

            foreach ($failures as $failure) {
                $errorDetails = [
                    'ligne' => $failure->row(),
                    'colonne' => $failure->attribute(),
                    'erreurs' => $failure->errors()
                ];
                Log::error('Échec d\'importation sur une ligne.', $errorDetails);

                $messages[] = 'Erreur à la ligne ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }

            // Retourner avec les messages d'erreur
            return back()->withErrors($messages)->withInput();
        } catch (\Exception $e) {
            Log::error('Erreur générale lors de l\'importation.', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            // En cas d'erreur générale
            return back()->withErrors(['Erreur lors de l\'importation : ' . $e->getMessage()]);
        }

        try {
            $adherents = Adherent::all();
            $ayantsDroit = AyantDroit::all();
            Log::info('Données des adhérents et ayants droit récupérées avec succès.', [
                'nombre_adherents' => $adherents->count(),
                'nombre_ayants_droit' => $ayantsDroit->count(),
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des données d\'adhérents ou d\'ayants droit.', [
                'exception' => $e->getMessage()
            ]);
            return back()->withErrors(['Erreur lors de la récupération des données : ' . $e->getMessage()]);
        }

        Log::info('Fin de l\'importation du fichier Excel.');

        return redirect()->route('adherents.index')
                         ->with('header', $header)
                         ->with('headerAyantDroit', $headerAyantDroit)
                         ->with('success', 'Importation réussie.');
    }
}
