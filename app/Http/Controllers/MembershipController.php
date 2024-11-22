<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemandeAdhesion;

class MembershipController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'matricule' => 'required|min:3',
            'nip' => 'required',
            // Add other validation rules here
        ]);

        $demandeAdhesion = DemandeAdhesion::create($validatedData);

        // Return a response with the ID for redirection
        return response()->json([
            'success' => true,
            'id' => $demandeAdhesion->id,
        ]);
    }
}

