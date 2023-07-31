<?php

namespace App\Http\Controllers;

use App\Models\TiposMedicamentos;
use App\Http\Requests\TipoMedicamentoRequest;
use App\Services\TipoMedicamentoService;

/**
 * Class TiposMedicamentosController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 13/07/2023 - 13:51
 * @package App\Http\Controllers
 */
class TiposMedicamentosController extends Controller
{

    protected $service;

    public function __construct(TipoMedicamentoService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Post(
     *     tags={"TipoMedicamento"},
     *     path="/tipoMedicamento/cadastro",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="descricao",
     *         required=true,
     *     ),
     *     @OA\Response(response="200", description="Cadastra os Tipos de medicamentos"),
     *     @OA\Response(response="401", description="Usuário não Autenticado"),
     *     @OA\Response(response="422", description="Erro em algum campo obrigatório"),
     * )
     */
    public function create(TipoMedicamentoRequest $request)
    {
        $tipoMedicamento = $this->service->create($request);

        return ['status' => true, "tiposMedicamentos" => $tipoMedicamento];
    }

    /**
     * @OA\Get(
     *      tags={"TipoMedicamento"},
     *      path="/tipoMedicamento/listar/",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(response="200", description="Lista os tipos de medicamentos cadastrados"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function list()
    {
        $tipoMedicamentos = $this->service->list();

        return ['status' => true, "tiposMedicamentos" => $tipoMedicamentos];
    }
}
