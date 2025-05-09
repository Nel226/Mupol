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

            'nom' => 'required',
            'prenom' => 'required',
            'genre' => 'required',
            'nombreAyantsDroits' => 'required|integer',
            'service' => 'required',
            'telephone' => 'required',
            'mensualite' => 'required',

            'date_enregistrement' => 'required|date',
        ];
    }
}
