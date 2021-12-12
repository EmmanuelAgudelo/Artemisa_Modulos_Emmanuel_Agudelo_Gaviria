<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = "eventos";

    protected $fillable = [
        "nombre",
        "descripcion",
        "valor_decoracion",
        "valor_entrada",
        "imagen",
        "estado",
        "inicio",
        "fin",
    ];

    public static $rules = [
        'nombre' => 'required|min:2',
        'descripcion' => 'required|min:2',
        'valor_decoracion' => 'required|numeric|min:0',
        'valor_entrada' => 'required|numeric|min:0',
        'estado' => 'in:1,0',
        'inicio' => 'required|min:2',
        'fin' => 'required|date'
    ];
}
