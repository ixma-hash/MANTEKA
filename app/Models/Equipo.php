<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipo extends Model
{
    protected $fillable = [
        'cliente_id',
        'nombre',
        'descripcion',
        'marca',
        'modelo',
        'numero_serie',
        'propiedad',
        'f_ingreso',
        'f_entrega',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}
