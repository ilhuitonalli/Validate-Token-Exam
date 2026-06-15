<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ValidatetokenApiRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return auth()->check();
    }

    /**
     * Reglas de validacion de la entrada de datos en la creacion del Api.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'key' => 'required|string|max:255',
        ];
    }
    /**
     * Mesajes de Validacion de la entrada de datos en la creacion del Api.
     */
    public function messages(): array
    {
        return [
            'key.required' => 'La llave es obligatoria.',
            'key.max' => 'La llave no puede tener más de 255 caracteres.',
        ];
    }
}
