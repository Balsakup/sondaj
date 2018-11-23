<?php

namespace App\Http\Requests\Admin\QuestionActions;

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
            'action_id'   => 'required|numeric|exists:actions,id',
            'question_id' => 'required|numeric|exists:questions,id'
        ];
    }

    public function messages()
    {
        return [
            'conditions.required'  => 'Les conditions sont requises',
            'conditions.string'    => 'Les conditions doivent être une chaîne de caractères',

            'action_id.required'   => 'L\'action est requise',
            'action_id.numeric'    => 'L\'action doit être un nombre',
            'action_id.exists'     => 'L\'action n\'existe pas',

            'question_id.required' => 'La question est requise',
            'question_id.numeric'  => 'La question doit être un nombre',
            'question_id.exists'   => 'La question n\'existe pas'
        ];
    }
}
