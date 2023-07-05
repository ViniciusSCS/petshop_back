<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pet_id',
        'user_id',
        'castrado',
        'vacina_id',
        'banho_tosa',
        'cirurgia_id',
        'user_created',
        'medicamento_id',
        'data_castracao',
        'descricao_cirurgia',
    ];

    public function dono_pet()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function veterinario_pet()
    {
        return $this->hasOne(User::class, 'id', 'user_created');
    }
}
