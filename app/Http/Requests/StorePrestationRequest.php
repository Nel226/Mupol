<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrestationRequest extends FormRequest
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
            'adherentCode' => 'required|string|max:255',
            'adherentNom' => 'required|string|max:255',
            'adherentPrenom' => 'required|string|max:255',
            'adherentSexe' => 'required|string',
            'beneficiaire' => 'required|string|max:255',
            'idPrestation' => 'required|string|max:255',
            'contactPrestation' => 'required|string|max:255',
            'acte' => 'required|string|max:255',
            
            // Validation des fichiers preuve
            'preuve' => 'nullable|array',
            'preuve.*' => 'image|mimes:jpeg,png,jpg|max:2048', // max 2 Mo par image

        ];
    }

    public function messages()
    {
        return [
            'preuve.*.image' => 'Chaque fichier doit être une image.',
            'preuve.*.mimes' => 'Les fichiers doivent être de type : jpeg, png ou jpg.',
            'preuve.*.max' => 'Chaque fichier ne doit pas dépasser 2 Mo.',
        ];
    }
}
