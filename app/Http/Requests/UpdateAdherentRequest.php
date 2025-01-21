<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdherentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nip' => 'required',
            'cnib' => 'required',
            'delivree' => 'required|date', 
            'expire' => 'required|date',   
            'adresse' => 'required',
            'genre' => 'required',
            'ville' => 'required',
            'departement' => 'required',
            'pays' => 'required',
            'nom_pere' => 'required',
            'nom_mere' => 'required',
            'situation_matrimoniale' => 'required',
            'nombreAyantsDroits' => 'required|integer',
            'nom_prenom_personne_besoin' => 'required',

            'lieu_residence' => 'required',
            'telephone_personne_prevenir' => 'required',
            'statut' => 'required',
            'dateDepartARetraite' => 'required',
            'grade' => 'required',

            'service' => 'required',
            'direction' => 'required',
            'region' => 'required',
            'province' => 'required',
            'localite' => 'required',

            'date_enregistrement' => 'required|date',
        ];
    }
}
