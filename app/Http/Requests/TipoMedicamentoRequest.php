<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TipoMedicamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $isVeterinario = Auth::user()->tipo_id == 1;

        if($isVeterinario == false){
            $this->failedAuthorization();
        }

        return $isVeterinario;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'descricao' => 'required|string',
        ];
    }

    public function failedAuthorization()
    {
        $message = 'Você não tem permissão para acessar esta funcionalidade.';
        abort(403, $message);
    }
}
