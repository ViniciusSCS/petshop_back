<?php

namespace App\Repository;

use App\Models\Especie;

class EspecieRepository
{
    public function select()
    {
        return $this->query();
    }

    protected function query()
    {
        return Especie::select(
            'id',
            'descricao'
        )
            ->get();
    }
}
