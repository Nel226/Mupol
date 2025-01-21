<?php

namespace App\Imports;

use App\Models\Adherent;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
class AdherentsImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        $dateExcel = trim($row['date_enregistrement']); // Enlever les espaces inutiles
    
        // Vérifier si c'est un nombre (date Excel)
        if (is_numeric($dateExcel)) {
            try {
                $date = Date::excelToDateTimeObject($dateExcel);
                $dateEnregistrement = Carbon::instance($date)->format('Y-m-d');
            } catch (\Exception $e) {
                Log::error('Erreur de conversion de date numérique : ' . $e->getMessage(), ['date_enregistrement' => $dateExcel]);
                return null;
            }
        } else {
            // Traitement des dates au format texte
            try {
                // D'abord, essayons de convertir avec l'année à deux chiffres 'd/m/y'
                $dateEnregistrement = Carbon::createFromFormat('d/m/y', $dateExcel)->format('Y-m-d');
            } catch (\Exception $e) {
                try {
                    // Si cela échoue, essayons avec l'année à quatre chiffres 'd/m/Y'
                    $dateEnregistrement = Carbon::createFromFormat('d/m/Y', $dateExcel)->format('Y-m-d');
                } catch (\Exception $e) {
                    Log::error('Erreur de conversion de date texte : ' . $e->getMessage(), ['date_enregistrement' => $dateExcel]);
                    return null;
                }
            }
        }
    
        return new Adherent([
           
            'date_enregistrement'=> $dateEnregistrement,
            'nom'                => $row['nom'],
            'prenom'             => $row['prenom'],
            'genre'              => $row['genre'],
            'service'            => $row['service'],
            'matricule'          => $row['no_matricule'],
            'code_carte'         => $this->calculateCodeCarte($row),
            'telephone'          => $row['telephone'],
            'charge'             => $row['charge'],
            'mensualite'         => $row['mensualite'],
            'adhesion'           => $row['adhesion'],
            'is_new'             => false,

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
        return "{$row['no_matricule']}/00";
    }

}
