<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAyantDroitRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required',
            'date_naissance' => 'required|date',
            'relation' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:1024',
            'extrait' => 'required|file|mimes:pdf|max:2048',
            'cnib' => 'nullable|file|mimes:pdf|max:2048',
        ];
    }
}
