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
    public function model(array $row)
    {
        Log::info('Début de traitement d\'une ligne du fichier.', ['row' => $row]);
    
        // Vérifiez si la clé 'date_enregistrement' existe
        if (!array_key_exists('date_enregistrement', $row) || empty(trim($row['date_enregistrement']))) {
            Log::warning('Clé "date_enregistrement" manquante ou vide.', ['row' => $row]);
            return null; // Ignorer la ligne si la clé n'existe pas ou si elle est vide
        }
    
        $dateExcel = trim($row['date_enregistrement']);
        $dateEnregistrement = null;
    
        try {
            // Vérifier si c'est un nombre (date Excel)
            if (is_numeric($dateExcel)) {
                $date = Date::excelToDateTimeObject($dateExcel);
                $dateEnregistrement = Carbon::instance($date)->format('Y-m-d');
                Log::info('Date Excel convertie avec succès.', ['date_enregistrement' => $dateEnregistrement]);
            } else {
                // Traitement des dates au format texte
                $dateEnregistrement = Carbon::createFromFormat('d/m/y', $dateExcel)->format('Y-m-d');
                Log::info('Date texte convertie avec succès.', ['date_enregistrement' => $dateEnregistrement]);
            }
        } catch (\Exception $e) {
            Log::error('Erreur de conversion de date.', [
                'exception' => $e->getMessage(),
                'date_enregistrement' => $dateExcel,
            ]);
            return null;
        }
    
        // Vérification des champs obligatoires
        if (empty($row['nom']) || empty($row['prenom']) || empty($row['no_matricule'])) {
            Log::warning('Un ou plusieurs champs obligatoires sont manquants.', [
                'nom' => $row['nom'] ?? null,
                'prenom' => $row['prenom'] ?? null,
                'no_matricule' => $row['no_matricule'] ?? null,
            ]);
            return null; // Ignorer la ligne si les champs sont incomplets
        }
    
        Log::info('Création d\'un nouvel adhérent.', [
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'matricule' => $row['no_matricule'],
        ]);
    
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
        Log::info('Calcul du code carte.', ['no_matricule' => $row['no_matricule']]);
        return "{$row['no_matricule']}/00";
    }
}
