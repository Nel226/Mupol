<?php

if (!function_exists('convertirNombreEnTexte')) {
    function convertirNombreEnTexte($nombre) {
        $unites = [
            '', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf'
        ];

        $dizaines = [
            '', 'dix', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante-dix', 'quatre-vingt', 'quatre-vingt-dix'
        ];

        if ($nombre < 10) {
            return $unites[$nombre];
        } elseif ($nombre < 100) {
            $dizaine = intval($nombre / 10);
            $unite = $nombre % 10;
            return $dizaines[$dizaine] . ($unite ? '-' . $unites[$unite] : '');
        } elseif ($nombre == 1000) {
            return 'mille';
        }

        // Pour l'année complète
        $centaines = intval($nombre / 100);
        $reste = $nombre % 100;
        $texte = ($centaines == 1 ? 'mille' : $unites[$centaines] . ' cent') . ($reste ? ' ' . convertirNombreEnTexte($reste) : '');

        return $texte;
    }
}
