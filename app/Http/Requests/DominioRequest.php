<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DominioRequest extends FormRequest
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
            'dominio' => 'required|regex:/(.*)\.com$/i',
        ];
    }

    public function messages()
    {
        return [
          'dominio.required' => 'El domino es requerido',
          'dominio.regex' => 'Debe ingresar un dominio .com'
        ];
    }
}
