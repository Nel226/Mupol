<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Http\Requests\StoreDepenseRequest;
use App\Http\Requests\UpdateDepenseRequest;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Dépenses',
                'url' => route('depenses.index'),
                'active' => true
            ],
            
        ];
        $pageTitle = 'Liste des dépenses';
        
        return view('pages.backend.comptabilite.depenses.index',
                    compact('pageTitle', 'breadcrumbsItems')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.backend.comptabilite.depenses.create');
    }

    public function categories()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Catégories',
                'url' => route('recettes.categories'),
                'active' => true
            ],
            
        ];
        $pageTitle = 'Catégories recettes';
        return view('pages.backend.comptabilite.depenses.categories',
                    compact('pageTitle', 'breadcrumbsItems')
        );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepenseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Depense $depense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depense $depense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepenseRequest $request, Depense $depense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depense $depense)
    {
        //
    }
}
