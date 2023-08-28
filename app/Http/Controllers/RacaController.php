<?php

namespace App\Http\Controllers;

use App\Models\Raca;
use App\Services\RacaService;
use Illuminate\Http\Request;

/**
 * Class RacaController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 13:51
 * @package App\Http\Controllers
 */
class RacaController extends Controller
{
    protected $service;

    public function __construct(RacaService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      tags={"Raca"},
     *      path="/raca/select/{id}",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Especie id",
     *          in="path",
     *          required=true,
     *      ),
     *      @OA\Response(response="200", description="Apreseta a Raça selecionada de acordo com o ID da espécie escolhida"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     *
     * @param Request $especie_id
     * @return App\Models\Raca
     */
    public function select($especieId)
    {
        $query = $this->service->select($especieId);

        return ['status' => true, "racas" => $query];
    }
}
