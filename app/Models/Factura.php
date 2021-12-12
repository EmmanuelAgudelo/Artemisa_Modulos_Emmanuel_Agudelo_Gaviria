<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = "facturas";

    public $timestamps = false;

    protected $fillable = [
        "id_cliente",
        "fecha",
        "total",
        "estado",
    ];

    public static $rules = [
        'estado' => 'in:1,0',
    ];
}
