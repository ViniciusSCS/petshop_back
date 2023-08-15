<?php

namespace App\Services;

use App\Repository\ProcedimentoRepository;

class ProcedimentoService
{
    protected $repository;

    public function __construct(ProcedimentoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create($request)
    {

        $procedimento = $this->repository->create($request);

        return $procedimento;
    }

    public function list()
    {
        return $this->repository->list();
    }
}
