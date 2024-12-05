<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetUpdateRequest extends FormRequest
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
            'nome' => 'sometimes|string',
            'peso' => 'sometimes|string',
            'raca_id' => 'sometimes',
            'sexo' => 'sometimes|string',
            'especie_id' => 'sometimes',
            'data_nascimento' => 'sometimes|string',
        ];
    }
}
