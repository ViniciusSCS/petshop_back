<?php

namespace App\Http\Controllers;

use App\Models\Raca;
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
    /**
     * @OA\Get(
     *      tags={"Raca"},
     *      path="/raca/select/{id}",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Especie id",
     *          in="/select/{id}",
     *          required=true,
     *      ),
     *      @OA\Response(response="200", description="Apreseta a Raça selecionada de acordo com o ID da espécie escolhida"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function select($especie_id)
    {
        $query = Raca::where('especie_id', $especie_id)->orWhere('especie_id', 4)->get();

        return ['status' => true, "racas" => $query];
    }
}
