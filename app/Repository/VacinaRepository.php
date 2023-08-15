<?php

namespace App\Repository;

use App\Models\Vacina;

class VacinaRepository
{
    public function findAll()
    {
        return Vacina::all();
    }
}
