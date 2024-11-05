<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecetteRequest extends FormRequest
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
            'montant' => 'required|numeric',
            'description' => 'required|string',
            'categorie_id' => 'required|exists:categories,uuid', // Vérifie que la catégorie existe
            'sous_categorie_id' => 'nullable|uuid|exists:categories,uuid',
            'date' => 'required|date',
        ];
    }
    public function messages()
    {
        return [
            'montant.required' => 'Le montant est requis.',
            'description.required' => 'La description est requise.',
            'categorie_id.required' => 'La catégorie est requise.',
            'date.required' => 'La date est requise.',
            // Ajouter d'autres messages personnalisés si nécessaire
        ];
    }
}
