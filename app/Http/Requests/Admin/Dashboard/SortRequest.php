<?php

namespace App\Http\Requests\Admin\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SortRequest extends FormRequest
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
            'model'=> 'required|string',
            'from' => 'required|numeric',
            'to'   => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'model.required' => 'Le modèle est requis',
            'model.string'   => 'Le modèle doit être une chaîne de caractères',

            'from.required'  => 'L\'ancien index est requis',
            'from.numeric'   => 'L\'ancien index doit être numérique',

            'to.required'    => 'Le nouvel index est requis',
            'to.numeric'     => 'Le nouvel index doit être numérique'
        ];
    }
}
