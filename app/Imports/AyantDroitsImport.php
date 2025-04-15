<?php

namespace App\Imports;

use App\Models\AyantDroit;
use App\Models\Adherent;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AyantDroitsImport implements ToModel, WithHeadingRow
{
    public $successfulRows = 0;
    public $failedRows = 0;

    public function model(array $row)
    {
        try {
            $requiredKeys = ['matricule_adherant', 'nom_ayant_droit', 'prenom_ayant_droit', 'sexe', 'date_naissance', 'relation', 'code'];

            $adherentExists = Adherent::where('matricule', $row['matricule_adherant'])->exists();
            if (!$adherentExists) {
                Log::error("ID d'adhérent non trouvé pour la ligne: " . json_encode($row));
                $this->failedRows++;
                return null;
            }

            $dateExcel = trim($row['date_naissance']);
            if (is_numeric($dateExcel)) {
                try {
                    $date = Date::excelToDateTimeObject($dateExcel);
                    $dateNaissance = Carbon::instance($date)->format('Y-m-d');
                } catch (\Exception $e) {
                    Log::error('Erreur de conversion de date numérique : ' . $e->getMessage(), ['date_naissance' => $dateExcel]);
                    $this->failedRows++;
                    return null;
                }
            } else {
                try {
                    $dateNaissance = Carbon::createFromFormat('d/m/y', $dateExcel)->format('Y-m-d');
                } catch (\Exception $e) {
                    try {
                        $dateNaissance = Carbon::createFromFormat('d/m/Y', $dateExcel)->format('Y-m-d');
                    } catch (\Exception $e) {
                        Log::error('Erreur de conversion de date texte : ' . $e->getMessage(), ['date_naissance' => $dateExcel]);
                        $this->failedRows++;
                        return null;
                    }
                }
            }
            if (AyantDroit::where('code', $row['code'])->exists()) {
                Log::warning('Code carte déjà existant, importation ignorée.', ['code' => $row['code']]);
                $this->failedRows++;
                return null;
            }
            $data = Adherent::pluck('matricule')->toArray();
            // $code = $this->generateCode($row['matricule_adherant'], $data);

        

            $ayantDroit = new AyantDroit();
            $ayantDroit->nom = $row['nom_ayant_droit'];
            $ayantDroit->prenom = $row['prenom_ayant_droit'];
            $ayantDroit->sexe = $row['sexe'] ?? 'Non spécifié';
            $ayantDroit->date_naissance = $dateNaissance;
            $ayantDroit->relation = $row['relation'];
            $ayantDroit->code = $row['code'];
            $ayantDroit->adherent_id = Adherent::where('matricule', $row['matricule_adherant'])->value('id');

            $this->successfulRows++;
            return $ayantDroit;

        } catch (\Exception $e) {
            Log::error("Erreur lors de l'importation de la ligne: " . json_encode($row));
            Log::error("Message d'erreur: " . $e->getMessage());
            $this->failedRows++;
        }
    }

    function generateCode($currentValue, $data)
    {
        $count = 1;
        foreach ($data as $value) {
            if ($value == $currentValue) {
                $count++;
            }
        }
        return $currentValue . "/" . str_pad($count, 2, "0", STR_PAD_LEFT);
    }
}
