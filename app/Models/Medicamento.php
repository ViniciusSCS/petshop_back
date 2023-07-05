<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descricao',
        'valor',
        'tipo_medicamento_id'
    ];

    public function tipo_medicamento()
    {
        return $this->hasOne(TiposMedicamentos::class, 'id', 'tipo_medicamento_id');
    }
}
