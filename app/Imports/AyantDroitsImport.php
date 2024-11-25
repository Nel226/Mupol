<?php

namespace App\Imports;

use App\Models\AyantDroit;
use App\Models\Adherent;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Importable;

class AyantDroitsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        try {
            // Afficher le contenu du tableau $row pour débogage
            Log::info('Contenu de la ligne : ' . json_encode($row));

            // Vérifier la présence des clés avant d'essayer d'y accéder
            $requiredKeys = [ 'matricule_adherent', 'nom_ayant_droit', 'prenom_ayant_droit', 'sexe', 'date_naissance', 'relation', 'code'];

            // Vérifier que l'ID d'adhérent existe
            $adherentExists = Adherent::where('no_matricule', $row['matricule_adherent'])->exists();
            if (!$adherentExists) {
                Log::error("ID d'adhérent non trouvé pour la ligne: " . json_encode($row));
                return null; // Skip this row
            }

            // Nettoyer la date de naissance
            $dateExcel = trim($row['date_naissance']); // Enlever les espaces inutiles
            if (is_numeric($dateExcel)) {
                // Traitement des dates numériques
                try {
                    $date = Date::excelToDateTimeObject($dateExcel);
                    $dateNaissance = Carbon::instance($date)->format('Y-m-d');
                } catch (\Exception $e) {
                    Log::error('Erreur de conversion de date numérique : ' . $e->getMessage(), ['date_naissance' => $dateExcel]);
                    return null;
                }
            }else {
                // Traitement des dates au format texte
                try {
                    // D'abord, essayons de convertir avec l'année à deux chiffres 'd/m/y'
                    $dateNaissance = Carbon::createFromFormat('d/m/y', $dateExcel)->format('Y-m-d');
                } catch (\Exception $e) {
                    try {
                        // Si cela échoue, essayons avec l'année à quatre chiffres 'd/m/Y'
                        $dateNaissance = Carbon::createFromFormat('d/m/Y', $dateExcel)->format('Y-m-d');
                    } catch (\Exception $e) {
                        Log::error('Erreur de conversion de date texte : ' . $e->getMessage(), ['date_naissance' => $dateExcel]);
                        return null;
                    }
                }
            } 
            
           

            // Générer le code
            $data = Adherent::pluck('no_matricule')->toArray();
            $code = $this->generateCode($row['matricule_adherent'], $data);

            // Création de l'objet AyantDroit
            $ayantDroit = new AyantDroit();
            $ayantDroit->nom = $row['nom_ayant_droit'] ?? 'Inconnu';
            $ayantDroit->prenom = $row['prenom_ayant_droit'] ?? 'Inconnu';
            $ayantDroit->sexe = $row['sexe'] ?? 'Non spécifié';
            $ayantDroit->date_naissance = $dateNaissance;
            $ayantDroit->relation = $row['relation'] ?? 'Non spécifiée';
            $ayantDroit->code = $code;
            $ayantDroit->adherent_id = Adherent::where('no_matricule', $row['matricule_adherent'])->value('id');

            return $ayantDroit;

        } catch (\Exception $e) {
            Log::error("Erreur lors de l'importation de la ligne: " . json_encode($row));
            Log::error("Message d'erreur: " . $e->getMessage());
        }
    }

    function generateCode($currentValue, $data) 
    {
        $count = 0;
        foreach ($data as $value) {
            if ($value == $currentValue) {
                $count++;
            }
        }
        return $currentValue . "/" . str_pad($count, 2, "0", STR_PAD_LEFT);
    }
}
