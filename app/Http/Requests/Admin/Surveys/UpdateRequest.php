<?php

namespace App\Http\Requests\Admin\Surveys;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'        => 'required|string|max:255|unique:surveys,name,' . $this->survey . ',id,deleted_at,NULL',
            'description' => 'string|nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'Le nom du questionnaire est requis',
            'name.string'        => 'Le nom du questionnaire doit être une chaîne de caractères',
            'name.max'           => 'Le nom du questionnaire ne doit pas dépasser 255 caractères',
            'name.unique'        => 'Le nom de questionnaire est déjà utilisé',

            'description.string' => 'La description du questionnaire doit être une chaîne de caractères'
        ];
    }
}
