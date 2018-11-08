<?php

namespace App\Http\Requests\Admin\Pages;

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
            'name' => 'required|string|max:255|unique:pages,name,' . $this->page . ',id,survey_id,NULL,deleted_at,NULL'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de la page est requis',
            'name.string'   => 'Le nom de la page doit être une chaîne de caractères',
            'name.max'      => 'Le nom de la page ne peut pas dépasser 255 caractères',
            'name.unique'   => 'Le nom de la page est déjà utilisé pour ce questionnaire'
        ];
    }
}
