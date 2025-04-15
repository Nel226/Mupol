<?php

namespace App\Imports;

use App\Models\Adherent;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use Illuminate\Support\Facades\Log;

class AdherentsImport implements ToModel, WithHeadingRow
{
    public $successfulRows = 0;
    public $failedRows = 0;
    public $errorMessages = []; // Ajout d'un tableau pour stocker les erreurs

    public function model(array $row)
    {
        // Log::info('Début de traitement d\'une ligne du fichier.', ['row' => $row]);

        if (!array_key_exists('date_enregistrement', $row) || empty(trim($row['date_enregistrement']))) {
            Log::warning('Clé "date_enregistrement" manquante ou vide.', ['row' => $row]);
            $this->failedRows++;
            
            return null;
        }

        $dateExcel = trim($row['date_enregistrement']);
        $dateEnregistrement = null;

        try {
            if (empty($dateExcel)) {
                Log::warning('Date vide ou nulle reçue.');
                $this->failedRows++;
                return null;
            }

            if (is_numeric($dateExcel)) {
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateExcel);
                $dateEnregistrement = \Carbon\Carbon::instance($date)->format('Y-m-d');
                // Log::info('Date Excel convertie avec succès.', ['date_enregistrement' => $dateEnregistrement]);
            } else {
                if (\Carbon\Carbon::hasFormat($dateExcel, 'd/m/Y')) {
                    $dateEnregistrement = \Carbon\Carbon::createFromFormat('d/m/Y', $dateExcel)->format('Y-m-d');
                    // Log::info('Date texte convertie avec succès.', ['date_enregistrement' => $dateEnregistrement]);
                } else {
                    Log::error('Format de date texte invalide.', ['date_enregistrement' => $dateExcel]);
                    $this->failedRows++;
                    return null;
                }
            }
        } catch (\Exception $e) {
            Log::error('Erreur de conversion de date.', [
                'exception' => $e->getMessage(),
                'date_enregistrement' => $dateExcel,
            ]);
            $this->failedRows++;
            return null;
        }

        if (empty($row['nom']) || empty($row['prenom']) || empty($row['no_matricule'])) {
            Log::warning('Un ou plusieurs champs obligatoires sont manquants.', [
                'nom' => $row['nom'] ?? null,
                'prenom' => $row['prenom'] ?? null,
                'no_matricule' => $row['no_matricule'] ?? null,
            ]);
            $this->failedRows++;
            return null;
        }

        if (Adherent::where('matricule', $row['no_matricule'])->exists()) {
            Log::warning('Matricule déjà existant, importation ignorée.', ['no_matricule' => $row['no_matricule']]);
            $this->failedRows++;
            return null;
        }

        $this->successfulRows++;

        // Log::info('Création d\'un nouvel adhérent.', [
        //     'nom' => $row['nom'],
        //     'prenom' => $row['prenom'],
        //     'matricule' => $row['no_matricule'],
        // ]);

        return new Adherent([
            'date_enregistrement' => $dateEnregistrement,
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'genre' => $row['genre'],
            'service' => $row['service'],
            'matricule' => $row['no_matricule'],
            'code_carte' => $this->calculateCodeCarte($row),
            'telephone' => $row['telephone'],
            'charge' => $row['charge'],
            'mensualite' => $row['mensualite'],
            'adhesion' => $row['adhesion'],
            'is_new' => false,
        ]);
    }

    /**
     * Calculer le code carte
     *
     * @param array $row
     * @return string
     */
    private function calculateCodeCarte(array $row)
    {
        // Log::info('Calcul du code carte.', ['no_matricule' => $row['no_matricule']]);
        return "{$row['no_matricule']}/00";
    }
}
