<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdherentRequest extends FormRequest
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'nom' => 'required',
            'prenom' => 'required',
            'matricule' => 'required|integer|max:20|unique:adherents,matricule',
            'region' => 'required',
            'province' => 'required',
            'localite' => 'required',
            'nip' => 'required',
            'cnib' => 'required',
            'delivree' => 'required|date',
            'expire' => 'required|date',
            'adresse' => 'required',
            'telephone' => 'required|integer',
            'email' => 'required|email',

            'genre' => 'required',
            'departement' => 'required',
            'ville' => 'required',
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
            'mensualite' => 'required|integer',
            'date_enregistrement' => 'required|date',
        ];
    }
}
