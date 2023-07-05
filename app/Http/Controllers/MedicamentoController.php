<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Http\Requests\MedicamentoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class MedicamentoController
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 13/07/2023 - 13:51
 * @package App\Http\Controllers
 */
class MedicamentoController extends Controller
{
    /**
     * @return Request
     * @return $medicamento
     */
    public function create(MedicamentoRequest $request)
    {
        $data = $request->all();

        $medicamento = new Medicamento();

        $medicamento->descricao = $data['descricao'];
        $medicamento->tipo_medicamento_id = $data['tipo_medicamento'];
        $medicamento->valor = $data['valor'];

        $medicamento->save();

        return ['status' => true, "medicamento" => $medicamento];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $query = Medicamento::select(
                'descricao',
                'tipo_medicamento_id',
                DB::raw("CONCAT('R$ ', valor) as valor")
            )
            ->with('tipo_medicamento')
            ->get();

        return ['status' => true, "medicamento" => $query];
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
    public function update(MedicamentoRequest $request, $id)
    {
        $data = $request->all();

        $medicamento = Medicamento::find($id);

        $medicamento->update($data);

        return ['status' => true, 'medicamento' => $medicamento];
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
