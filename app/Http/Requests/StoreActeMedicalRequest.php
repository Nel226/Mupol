<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActeMedicalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:255|unique:acte_medicals,code',
            'designation' => 'required|string|max:255',
            'cout' => 'required|numeric|min:0',
            'plafond' => 'required|numeric|min:0',
            'date_creation' => 'required|date',
            'date_invalidite' => 'nullable|date|after_or_equal:date_creation',
        ];
    }
}
