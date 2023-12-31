<?php

namespace App\Services;

use App\Models\Medicamento;
use App\Repository\MedicamentoRepository;
use Illuminate\Support\Facades\DB;

class MedicamentoService
{
    protected $repository;

    public function __construct(MedicamentoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($request)
    {
        $data = $request->all();

        return $this->repository->create($data);
    }

    public function list()
    {
        return $this->repository->list();
    }

    public function update($data, $id)
    {
        return $this->repository->update($data, $id);
    }

    public function search($request)
    {
        return $this->repository->search($request);
    }
}
