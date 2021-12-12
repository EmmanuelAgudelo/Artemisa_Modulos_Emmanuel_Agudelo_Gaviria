<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clientes";

    protected $fillable = [
        "nombre",
        "apellidos",
        "documento",
        "telefono",
        "email",
        "estado",
    ];

    public static $rules = [
        'nombre' => 'required|min:2',
        'apellidos' => 'required|min:2',
        'documento' => 'required|numeric|min:2',
        'telefono' => 'required|numeric|min:2',
        'email' => 'required|min:2|email',
        'estado' => 'in:1,0',
    ];
}
