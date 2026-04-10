<?php

namespace App\Http\Requests;

use App\Constants\Geral;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Auth;

class MedicamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->tipo_id == Geral::VETERINARIO;
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
            'tipo_medicamento' => 'required',
            'valor' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.string' => 'O campo descrição deve ser uma string.',
            'tipo_medicamento.required' => 'O campo tipo medicamentno é obrigatório.',
            'valor.required' => 'O campo valor é obrigatório.'
        ];
    }

    public function failedAuthorization()
    {
        $message = 'Você não tem permissão para acessar esta funcionalidade.';
        abort(403, $message);
    }
}
