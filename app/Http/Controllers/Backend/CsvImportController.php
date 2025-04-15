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
        // Log::info('Début de l\'importation du fichier Excel.');

        $validator = Validator::make($request->all(), [
            'excel-file' => 'required|mimes:xlsx'
        ]);

        if ($validator->fails()) {
            Log::warning('Validation échouée pour le fichier Excel.', ['errors' => $validator->errors()->all()]);
            return back()->withErrors($validator)->withInput();
        }

        $file = $request->file('excel-file');

        $import = new AdherentsImport();
        $messages = [];

        try {
            // Log::info('Début de l\'importation des données Excel.');
            Excel::import($import, $file);
            // Log::info('Importation des données Excel terminée avec succès.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            Log::error('Erreur de validation lors de l\'importation.', ['exception' => $e->getMessage()]);
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $errorDetails = [
                    'ligne' => $failure->row(),
                    'colonne' => $failure->attribute(),
                    'erreurs' => $failure->errors()
                ];
                Log::error('Échec d\'importation sur une ligne.', $errorDetails);

                $messages[] = 'Erreur à la ligne ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
        } catch (\Exception $e) {
            Log::error('Erreur générale lors de l\'importation.', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['Erreur lors de l\'importation : ' . $e->getMessage()]);
        }
            
        return redirect()->route('adherents.index')
            ->with('success', "Importation terminée : {$import->successfulRows} lignes réussies, {$import->failedRows} lignes échouées.")
            ->with('failedDetails', $messages);
    }
}
