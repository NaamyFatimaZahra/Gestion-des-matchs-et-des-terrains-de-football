<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SquadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Mettez cette valeur à true pour autoriser la requête
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_sqaud' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'formation' => ['required', Rule::in(['121', '331', '433'])],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name_sqaud.required' => 'Le nom du terrain est obligatoire.',
            'name_sqaud.string' => 'Le nom doit être une chaîne de caractères.',
            'name_sqaud.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            
            'city.required' => 'La ville est obligatoire.',
            'city.string' => 'La ville doit être une chaîne de caractères.',
            'city.max' => 'Le nom de la ville ne doit pas dépasser 255 caractères.',
            
            'formation.required' => 'Veuillez sélectionner une formation.',
            'formation.in' => 'La formation sélectionnée est invalide.',
        ];
    }
}