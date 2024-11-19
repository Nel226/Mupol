<?php

namespace App\Http\Controllers;

use App\Models\CentreSante;
use App\Http\Requests\StoreCentreSanteRequest;
use App\Http\Requests\UpdateCentreSanteRequest;

class CentreSanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centresSante = CentreSante::all();
        return view('centres_sante.index', compact('centresSante'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('centres_sante.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCentreSanteRequest $request)
    {
        CentreSante::create($request->validated());
        return redirect()->route('centres_sante.index')->with('success', 'Centre de santé ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $centre = CentreSante::findOrFail($id);
        return view('centres_sante.show', compact('centre'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CentreSante $centreSante)
    {
        return view('centres_sante.edit', compact('centreSante'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCentreSanteRequest $request, CentreSante $centreSante)
    {
        $centreSante->update($request->validated());
        return redirect()->route('centres_sante.index')->with('success', 'Centre de santé mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CentreSante $centreSante)
    {
        $centreSante->delete();
        return redirect()->route('centres_sante.index')->with('success', 'Centre de santé supprimé avec succès.');
    }

}
