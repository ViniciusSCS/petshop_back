<?php

namespace App\Services;

use App\Repository\EspecieRepository;

class EspecieService
{
    protected $repository;

    public function __construct(EspecieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function select()
    {
        return $this->repository->select();
    }
}
