<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProfessionnelRequest extends FormRequest
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
            'prenom'=>['required','string', 'max:25'],
            'nom'=>['required','string', 'max:40'],
            'cp'=>['required','string', 'between:5,5'],
            'ville'=>['required','string', 'max:38'],
            'telephone'=>['required','string', 'max:14'],
            'email'=>['required','email:rfc,dns', Rule::unique('professionnels')->ignore($this->professionnel)],
            'naissance'=>['required','date_format:Y-m-d'],
            'formation'=>['required'],
            'domaine'=>['required'],
            'metier_id'=>['required']
        ];
    }

    public function messages(){
        return [
            'metier_id.required' => 'Le champ metier est obligatoire.',
            'cp.between' => 'Le code postal doit contenir 5 caractères.'
        ];
    }
}
