<?php

namespace App\Http\Requests\Admin\Pages;

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
            'name'      => 'required|string|max:255|unique:pages,name,NULL,id,survey_id,NULL,deleted_at,NULL',
            'survey_id' => 'required|numeric|exists:surveys,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'Le nom de la page est requis',
            'name.string'        => 'Le nom de la page doit être une chaîne de caractères',
            'name.max'           => 'Le nom de la page ne peut pas dépasser 255 caractères',
            'name.unique'        => 'Le nom de la page est déjà utilisé pour ce questionnaire',

            'survey_id.required' => 'Le questionnaire associé est requis',
            'survey_id.numeric'  => 'Le questionnaire associé doit être un numérique',
            'survey_id.exists'   => 'Le questionnaire associé n\'existe pas'
        ];
    }
}
