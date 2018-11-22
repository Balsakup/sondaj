<?php

namespace App\Http\Requests\Admin\QuestionRules;

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
            'conditions'  => 'required|string',
            'rule_id'     => 'required|numeric|exists:rules,id',
            'question_id' => 'required|numeric|exists:questions,id'
        ];
    }

    public function messages()
    {
        return [
            'conditions.required'  => 'Les conditions sont requis',
            'conditions.string'    => 'Les conditions doit être une chaîne de caractères',

            'rule_id.required'     => 'La règle est requise',
            'rule_id.numeric'      => 'La règle doit être un nombre',
            'rule_id.exists'       => 'La règle n\'existe pas',

            'question_id.required' => 'La question est requise',
            'question_id.numeric'  => 'La question doit être un nombre',
            'question_id.exists'   => 'La question n\'existe pas'
        ];
    }
}
