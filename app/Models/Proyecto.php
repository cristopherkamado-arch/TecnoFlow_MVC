<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    // Campos que se pueden llenar desde un formulario
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'cliente_id',
    ];

    // Un proyecto pertenece a un solo cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
