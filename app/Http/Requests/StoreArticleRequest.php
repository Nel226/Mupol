<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'titre' => 'required|string|max:255',
            'categorie' => 'required|string|max:100',
            'resume' => 'nullable|string|max:400',
            'date' => 'required|date', 

            'contenu' => 'required|string', 
            'image_principal' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ];
    }
}
