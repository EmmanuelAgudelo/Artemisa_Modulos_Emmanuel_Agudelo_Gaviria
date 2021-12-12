<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\DetalleFactura;
use App\Models\Cliente;
use App\Models\Factura;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FacturaController extends Controller
{
    public function index()
    {

        return view('factura.index');
    }
    public function detalles()
    {

        return view('factura.detalles');
    }

    public function crear()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();


        return view('factura.crear', compact("clientes", "productos"));
    }


    public function guardar(Request $request)
    {
        $request->validate(Factura::$rules);
        $input = $request->all();

        try {
            DB::beginTransaction();
            $factura = Factura::create([
                "total" => $this->calcular_precio($input["producto_id"], $input["cantidades"]),
                "id_cliente" => $input["cliente"],
                "fecha" => now(),
                "estado" => 1
            ]);

            foreach ($input["producto_id"] as $key => $value) {
                DetalleFactura::create([
                    "id_factura" => $factura->id,
                    "id_producto" => $value,
                    "cantidad" => $input["cantidades"][$key],
                    "precio" => $input["precios"][$key]

                ]);

                $prod = Producto::find($value);
                $prod->update(["cantidad" => $prod->cantidad - $input["cantidades"][$key]]);
            }

            DB::commit();

            return redirect('/factura')->with('success', 'Factura creada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/factura')->with('error', $e->getMessage());
        }
    }

    public function calcular_precio($productos, $cantidad)
    {
        $precio = 0;
        foreach ($productos as $key => $value) {
            $producto = Producto::find($value);
            $precio += ($producto->precio_base * $cantidad[$key]);
        }
        return $precio;
    }


    public function listar()
    {
        $facturas = Factura::select("facturas.*", "clientes.documento")
            ->join("clientes", "facturas.id_cliente", "=", "clientes.id")
            ->get();

        return DataTables::of($facturas)
            ->addColumn("estado", function ($factura) {
                if ($factura->estado == 1) {
                    return '<span class="badge bg-success">Activo</span>';
                } else {
                    return '<span class="badge bg-danger">Inactivo</span>';
                }
            })
            ->addColumn("acciones", function ($factura) {

                if ($factura->estado == 1) {
                    return '<a class="btn btn-danger me-2"  href="/factura/cambiar/estado/' . $factura->id . '/0"><i class="fas fa-user-slash"></i></a>' . '<a  class="btn btn-primary"  href="/factura/show?id=' . $factura->id . '"
                     title="show">
                    <i class="fas fa-eye fa-lg"></i>
                </a>';
                } else {
                    return '<a class="btn btn-success me-2" href="/factura/cambiar/estado/' . $factura->id . '/1"><i class="fas fa-user-check"></i></a>' . '<a class="btn btn-primary" href="/factura/show?id=' . $factura->id . '" 
                    title="show">
                   <i class="fas fa-eye fa-lg"></i>
               </a>';
                }
            })
            ->rawColumns(['estado', 'acciones'])
            ->make(true);
    }

    public function show(Request $request)
    {
        $id = $request->input("id");
        $detalles = [];
        if ($id != null) {
            $detalles = Producto::select("productos.*", "detalles_facturas.cantidad as cantidad_t", "detalles_facturas.id_factura")
                ->join("detalles_facturas", "productos.id_producto", "=", "detalles_facturas.id_producto")
                ->where("detalles_facturas.id_factura", "=", $id)
                ->get();

            $clientes = Factura::select("facturas.*", "clientes.documento", "clientes.nombre", "clientes.apellidos")
                ->join("clientes", "facturas.id_cliente", "=", "clientes.id")
                ->where("facturas.id", "=", $id)
                ->get();
        }

        return view("factura.detalles", compact("detalles", "clientes"));
    }


    public function updateState($id, $estado)
    {
        try {
            Factura::where('id', '=', $id)->update(['estado' => $estado]);

            return redirect('/factura')->with('success', 'Se modificó el estado de la factura');
        } catch (\Exception $e) {
            return redirect('/factura')->with('error', $e->getMessage());
        }
    }
}
