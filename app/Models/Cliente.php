<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // Campos que se pueden llenar desde un formulario.
    protected $fillable = [
        'tipo_cliente',
        'codigo',
        'nombre',
        'email',
        'telefono',
        'direccion',
    ];

    // Un cliente tiene muchos proyectos.
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class);
    }
}
