<?php

namespace App\Http\Controllers;

use App\Services\ProcedimentoService;
use Illuminate\Http\Request;

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

    protected $service;

    public function __construct(ProcedimentoService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Post(
     *      tags={"Procedimento"},
     *      path="/procedimento/cadastro",
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
        $procedimento = $this->service->create($request);

        return ['status' => true, "procedimento" => $procedimento];
    }

    /**
     * @OA\Get(
     *     tags={"Procedimento"},
     *     path="/procedimento/listar",
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(response="200", description="Apresenta a informação do Pet selecionado"),
     *     @OA\Response(response="204", description="Procedimento não encotrado"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     *
     * @return App\Models\Procedimento
     */
    public function list()
    {
        $procedimento = $this->service->list();

        return ['status' => true, "procedimento" => $procedimento];
    }

    public function search(Request $request)
    {
        $procedimento = $this->service->search($request);

        return ['status' => true, "procedimento" => $procedimento];
    }
}
