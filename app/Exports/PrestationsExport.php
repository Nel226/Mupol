<?php

namespace App\Exports;

use App\Models\Prestation;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PrestationsExport implements FromView
{
    public function view(): View
    {
        return view('pages.backend.prestations.statistiques', [
            'prestations' => Prestation::all() // ou ta requête filtrée
        ]);
    }
}
