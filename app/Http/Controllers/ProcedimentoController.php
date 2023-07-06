<?php

namespace App\Http\Controllers;

use App\Models\Procedimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProcedimentoController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 15:26
 * @package App\Http\Controllers
 */
class ProcedimentoController extends Controller
{

    /**
     * @OA\Post(
     *      tags={"Procedimento"},
     *      path="/procedimeto/cadastro",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="pet_id",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="vacina",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="castrado",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="cirurgia",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="banho_tosa",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="user_id",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="data_castracao",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="user_created",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="descricao_cirurgia",
     *          required=true,
     *      ),
     *      @OA\Parameter(
     *          name="medicamento_id",
     *          required=true,
     *      ),
     *      @OA\Response(response="200", description="Cadastra as os procedimentos"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     *      @OA\Response(response="422", description="Erro em algum campo obrigatório"),
     * )
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $procedimento = new Procedimento();

        $procedimento->pet_id = $data['pet_id'];
        $procedimento->vacina_id = $data['vacina'];
        $procedimento->castrado = $data['castrado'];
        $procedimento->cirurgia_id = $data['cirurgia'];
        $procedimento->banho_tosa = $data['banho_tosa'];
        $procedimento->user_id = $data['user_id']['id'];
        $procedimento->data_castracao = $data['data_castracao'];
        $procedimento->user_created = $data['user_created']['id'];
        $procedimento->descricao_cirurgica = $data['descricao_cirurgia'];
        $procedimento->medicamento_id = $data['medicamento_id'];

        $procedimento->save();

        return ['status' => true, "procedimento" => $procedimento];

    }

    /**
     * @OA\Get(
     *     tags={"Procedimento"},
     *     path="/procedimeto/listar",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Apresenta a informação do Pet selecionado"),
     *     @OA\Response(response="204", description="Pet não encotrado"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function list(Request $request)
    {
        $query = Procedimento::with('dono_pet')
            ->with('veterinario_pet')
            ->get();

        return ['status' => true, "procedimento" => $query];

    }
}
