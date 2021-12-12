<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $table = "detalles_facturas";
    public $timestamps = false;

    protected $fillable = [
        "precio",
        "cantidad",
        "id_factura",
        "id_producto",
    ];
}
