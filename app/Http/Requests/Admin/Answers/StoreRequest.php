<?php

namespace App\Http\Requests\Admin\Answers;

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
            'name'        => 'required|string|max:255',
            'value'       => 'string|max:255|nullable',
            'question_id' => 'required|numeric|exists:questions,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'Le nom de la réponse est requis',
            'name.string'          => 'Le nom de la réponse doit être une chaîne de caractères',
            'name.max'             => 'Le nom de la réponse ne doit pas dépasser 255 caractères',

            'value.string'         => 'La valeur de la réponse doit être une chaîne de caractères',
            'value.max'            => 'La valeur de la réponse ne doit pas dépasser 255 caractères',

            'question_id.required' => 'La question associée est requise',
            'question_id.numeric'  => 'La question associée doit être numérique',
            'question_id.exists'   => 'La question associée n\'existe pas'
        ];
    }
}
