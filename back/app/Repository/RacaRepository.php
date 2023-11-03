<?php

namespace App\Repository;

use App\Models\Raca;

class RacaRepository
{
    public function select($especieId)
    {
        return Raca::where('especie_id', $especieId)->orWhere('especie_id', 4)->get();
    }
}
