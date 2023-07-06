<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Illuminate\Http\Request;

/**
 * Class EspecieController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 13:51
 * @package App\Http\Controllers
 */
class EspecieController extends Controller
{
   /**
     * @OA\Get(
     *      tags={"Especie"},
     *      path="/especie/select",
     *      security={{"bearerAuth": {}}},
     *      @OA\Response(response="200", description="Apreseta todas as Espécies"),
     *      @OA\Response(response="401", description="Usuário não Autenticado"),
     * )
     */
    public function select()
    {
        $query = Especie::all();

        return ['status' => true, "especies" => $query];
    }
}
