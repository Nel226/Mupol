<?php

namespace App\Helpers;

class DateHelper
{
    public static function convertirDateEnLettres($date)
    {
        // Créer un tableau pour les nombres en lettres
        $nombresEnLettres = [
            0 => 'zéro', 1 => 'un', 2 => 'deux', 3 => 'trois', 4 => 'quatre',
            5 => 'cinq', 6 => 'six', 7 => 'sept', 8 => 'huit', 9 => 'neuf',
            10 => 'dix', 11 => 'onze', 12 => 'douze', 13 => 'treize', 14 => 'quatorze',
            15 => 'quinze', 16 => 'seize', 17 => 'dix-sept', 18 => 'dix-huit', 19 => 'dix-neuf',
            20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante',
            60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingts', 90 => 'quatre-vingt-dix'
        ];

        // Convertir la date en timestamp
        $timestamp = strtotime($date);
        
        // Extraire l'année, le mois et le jour
        $annee = date('Y', $timestamp);
        $mois = date('n', $timestamp);
        $jour = date('j', $timestamp);
        
        // Convertir l'année en lettres
        $anneeEnLettres = self::convertirAnneeEnLettres($annee, $nombresEnLettres);
        
        // Formater le mois en lettres
        $moisEnLettres = [ 
            1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril', 5 => 'mai',
            6 => 'juin', 7 => 'juillet', 8 => 'août', 9 => 'septembre', 10 => 'octobre',
            11 => 'novembre', 12 => 'décembre'
        ][$mois];

        // Convertir le jour en lettres
        $jourEnLettres = self::convertirJourEnLettres($jour, $nombresEnLettres);
        
        // Retourner la date en lettres
        return "L'an $anneeEnLettres et le $jourEnLettres $moisEnLettres";
    }

    private static function convertirJourEnLettres($jour, $nombresEnLettres)
    {
        // Traiter le cas des jours de 21 à 29 qui ont une forme spéciale
        if ($jour > 20) {
            return $nombresEnLettres[20] . '-' . $nombresEnLettres[$jour - 20];
        }
        
        return $nombresEnLettres[$jour];
    }

    private static function convertirAnneeEnLettres($annee, $nombresEnLettres)
    {
        $anneeEnLettres = "";
        
        // Traiter les milliers
        if ($annee >= 2000) {
            $anneeEnLettres .= "deux mille ";
            $annee -= 2000;
        }
        
        // Traiter les dizaines et les unités
        if ($annee > 0) {
            if ($annee < 20) {
                $anneeEnLettres .= $nombresEnLettres[$annee];
            } else {
                $dizaines = (int)($annee / 10) * 10;
                $unites = $annee % 10;
                $anneeEnLettres .= $nombresEnLettres[$dizaines];
                if ($unites > 0) {
                    $anneeEnLettres .= '-' . $nombresEnLettres[$unites];
                }
            }
        }
        
        return trim($anneeEnLettres);
    }
}
