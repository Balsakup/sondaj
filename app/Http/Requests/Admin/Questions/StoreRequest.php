<?php

namespace App\Http\Requests\Admin\Questions;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => 'required|string|max:255',
            'question_type_id' => 'required|numeric|exists:question_types,id',
            'page_id'          => 'required|numeric|exists:pages,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => 'Le nom de la question est requis',
            'name.string'               => 'Le nom de la question doit être une chaîne de caractère',
            'name.max'                  => 'Le nom de la question ne doit pas dépasser 255 caractères',

            'question_type_id.required' => 'Le type de la question est requis',
            'question_type_id.numeric'  => 'Le type de la question doit être numérique',
            'question_type_id.exists'   => 'Le type de la question n\'existe pas',

            'page_id.required'          => 'La page associée est requise',
            'page_id.numeric'           => 'La page associée doit être numérique',
            'page_id.exists'            => 'La page associée n\'existe pas'
        ];
    }
}
