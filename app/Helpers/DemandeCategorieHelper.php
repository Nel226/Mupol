<?php

namespace App\Helpers;

class DemandeCategorieHelper
{
    public static function determineCategorie($nombreAyantsDroits)
    {
        if ($nombreAyantsDroits < 0) {
            throw new \InvalidArgumentException("Le nombre d'ayants droits ne peut pas être négatif.");
        }

        return ($nombreAyantsDroits === 0) ? 1 : min($nombreAyantsDroits + 1, 7); // Limite à 7 pour 6 ayants droits
    }

    public static function calculerCotisationMensuelleTotale($nombreAyantsDroits , $statut)
    {
        $fraisAdhesion = 10000;
        $cotisationAdherent = ($statut === 'Retraité(e)') ? 3000 : 5000;
        $cotisationAyantsDroits = 2000 * $nombreAyantsDroits; 

        $cotisationTotale =  $cotisationAdherent + $cotisationAyantsDroits;

        return [
            'fraisAdhesion' => $fraisAdhesion,
            'cotisationAdherent' => $cotisationAdherent,
            'cotisationAyantsDroits' => $cotisationAyantsDroits,
            'cotisationTotale' => $cotisationTotale,
        ];
    }
}
