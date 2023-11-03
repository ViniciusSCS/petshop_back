<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Pet
 *
 * @autor Vinícius Sarmento Costa Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 02/07/2021 - 13:51
 * @package App\Models
 */
class Pet extends Model
{
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'peso',
        'sexo',
        'raca_id',
        'user_id',
        'especie_id',
        'data_nascimento',
        'data_falecimento',
    ];

    public function especie()
    {
        return $this->hasOne(Especie::class, 'id', 'especie_id');
    }

    public function raca()
    {
        return $this->hasOne(Raca::class, 'id', 'raca_id');
    }

    public function procedimento()
    {
        return $this->hasMany(Procedimento::class, 'pet_id', 'id');
    }

    public function tutor()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
