<?php

namespace App\Services;

use App\Models\TiposMedicamentos;
use App\Repository\TipoMedicamentoRepository;

class TipoMedicamentoService
{
    protected $repository;

    public function __construct(TipoMedicamentoRepository $repository)
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
}
