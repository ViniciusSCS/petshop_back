<?php

namespace App\Services;

use App\Models\Procedimento;
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
        $user = $request->user();
        $data = $request->all();

        $procedimento = $this->repository->create($data, $user);

        return $procedimento;
    }

    public function list()
    {
        return $this->repository->list();
    }
}
