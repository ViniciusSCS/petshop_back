<?php

namespace App\Services;

use App\Repository\RacaRepository;

class RacaService
{
    protected $repository;

    public function __construct(RacaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function select($especieId)
    {
        return $this->repository->select($especieId);
    }
}
