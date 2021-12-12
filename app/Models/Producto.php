<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        "nombre_producto",
        "precio_base",
        "cantidad",
        "estado",
    ];

    public static $rules = [
        'nombre_producto' => 'required|min:2',
        'precio_base' => 'required|numeric|min:0',
        'cantidad' => 'required|numeric|min:0',
        'estado' => 'in:1,0'

    ];
}
