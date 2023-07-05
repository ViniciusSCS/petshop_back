<?php

namespace App\Http\Controllers;

use App\Models\TiposMedicamentos;
use App\Http\Requests\TipoMedicamentoRequest;
use Illuminate\Http\Request;

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
    /**
     * Lista Tipo de Medicamentos cadastrados.
     *
     * @return $query
     */
    public function list()
    {
        $query = TiposMedicamentos::select('descricao')->get();

        return ['status' => true, "tiposMedicamentos" => $query];
    }

    /**
     * Cadastra Tipos de Medicamentos.
     *
     * @param Request $request
     * @return $tipoMedicamento
     */
    public function create(TipoMedicamentoRequest $request)
    {
        $data = $request->all();

        $tipoMedicamento = new TiposMedicamentos();

        $tipoMedicamento->descricao = $data['descricao'];

        $tipoMedicamento->save();

        return ['status' => true, "tiposMedicamentos" => $tipoMedicamento];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
