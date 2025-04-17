<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TerrainRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'capacity' => 'required|integer|min:10',
            'price' => 'required|numeric|min:0',
            'surface' => 'required|in:gazon_naturel,gazon_synthetique,gazon_hybride,turf_artificiel,stabilise,sable,beton,terre_battue,indoor_synthetique,altra_resist',
            'payment_method' => 'required',
            'city' => 'required|string',
            'adress' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'services' => 'required',
            'services.*' => 'required|exists:services,id',
            'contact'=>'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Le nom du terrain est obligatoire.',
            'name.string' => 'Le nom du terrain doit être une chaîne de caractères.',
            
            'description.required' => 'La description du terrain est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            
            'capacity.required' => 'La capacité du terrain est obligatoire.',
            'capacity.integer' => 'La capacité doit être un nombre entier.',
            'capacity.min' => 'La capacité minimale est de 10 personnes.',
            
            'price.required' => 'Le prix du terrain est obligatoire.',
            'price.numeric' => 'Le prix doit être un nombre.',
            'price.min' => 'Le prix ne peut pas être négatif.',
            
            'surface.required' => 'Le type de surface est obligatoire.',
            'surface.in' => 'Le type de surface sélectionné n\'est pas valide.',
            
            'payment_method.required' => 'La méthode de paiement est obligatoire.',
            
            'city.required' => 'La ville est obligatoire.',
            'city.string' => 'La ville doit être une chaîne de caractères.',
            
            'adress.required' => 'L\'adresse est obligatoire.',
            'adress.string' => 'L\'adresse doit être une chaîne de caractères.',
            
            'latitude.required' => 'La latitude est obligatoire.',
            'latitude.numeric' => 'La latitude doit être une valeur numérique.',
            
            'longitude.required' => 'La longitude est obligatoire.',
            'longitude.numeric' => 'La longitude doit être une valeur numérique.',
            
            'images.required' => 'Au moins une image est obligatoire.',
            'images.array' => 'Le format des images n\'est pas valide.',
            'images.*.image' => 'Le fichier doit être une image.',
            'images.*.mimes' => 'L\'image doit être au format jpg, jpeg, png ou webp.',
            'images.*.max' => 'La taille de l\'image ne doit pas dépasser 5Mo.',
            
            'services.required' => 'Au moins un service est obligatoire.',
            'services.*.required' => 'Chaque service est obligatoire.',
            'services.*.exists' => 'Le service sélectionné n\'existe pas.',
        ];
    }
}