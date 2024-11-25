<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\ActeMedical;
use App\Http\Requests\StoreActeMedicalRequest;
use App\Http\Requests\UpdateActeMedicalRequest;

class ActeMedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actes = ActeMedical::all();
        return view('acte_medicals.index', compact('actes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('acte_medicals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActeMedicalRequest $request)
    {
        $validatedData = $request->validated();

        ActeMedical::create($validatedData);

        return redirect()->route('acte_medicals.index')->with('success', 'Acte médical créé avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(ActeMedical $acteMedical)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActeMedical $acteMedical)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActeMedicalRequest $request, ActeMedical $acteMedical)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActeMedical $acteMedical)
    {
        $acteMedical->delete();

        return redirect()->route('acte_medicals.index')->with('success', 'Acte médical supprimé avec succès.');
    }
}
