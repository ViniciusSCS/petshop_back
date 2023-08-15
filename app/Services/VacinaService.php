<?php

namespace App\Services;

use App\Repository\VacinaRepository;

class VacinaService
{
    protected $repository;

    public function __construct(VacinaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }
}
