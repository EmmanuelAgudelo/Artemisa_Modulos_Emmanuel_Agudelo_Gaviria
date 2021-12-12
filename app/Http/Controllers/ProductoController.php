<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Yajra\DataTables\Facades\DataTables;

class ProductoController extends Controller
{
    public function index()
    {
        return view('producto.index');
    }

    public function listar(Request $request)
    {
        $productos = Producto::all();

        return DataTables::of($productos)
            ->addColumn("estado", function ($producto) {
                if ($producto->estado == 1) {
                    return '<span class="badge bg-success">Activo</span>';
                } else {
                    return '<span class="badge bg-danger">Inactivo</span>';
                }
            })
            ->addColumn("acciones", function ($producto) {

                if ($producto->estado == 1) {
                    return '<a class="btn btn-primary me-2" href="/producto/editar/' . $producto->id_producto . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-danger" href="/producto/cambiar/estado/' . $producto->id_producto . '/0"><i class="fas fa-ban"></i></a>';
                } else {
                    return '<a class="btn btn-primary me-2" href="/producto/editar/' . $producto->id_producto . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-success" href="/producto/cambiar/estado/' . $producto->id_producto . '/1"><i class="fas fa-check"></i></a>';
                }
            })
            ->rawColumns(['estado', 'acciones'])
            ->make(true);
    }

    public function crear()
    {
        return view('producto.crear');
    }

    public function guardar(Request $request)
    {

        $request->validate(Producto::$rules);
        $input = $request->all();
        try {
            Producto::create([

                "nombre_producto" => $input["nombre_producto"],
                "precio_base" => $input["precio_base"],
                "cantidad" => $input["cantidad"],
                "estado" => 1
            ]);
            return redirect('/producto')->with('success', 'Producto creado exitosa');
        } catch (\Exception $e) {
            return redirect('/producto')->with('error', 'El nombre del producto ya existe');
        }
    }

    public function editar($id)
    {
        $producto = Producto::find($id);

        if ($producto == null) {
            return redirect('/producto')->with('error', 'Producto no encontrado');
        }

        return view("producto.editar", compact("producto"));
    }


    public function update(Request $request)
    {

        $request->validate(Producto::$rules);
        $input = $request->all();

        try {

            $producto = Producto::find($input["id"]);

            if ($producto == null) {
                return redirect('/producto')->with('error', 'Producto no encontrado');
            }

            $producto->update([
                "nombre_producto" => $input["nombre_producto"],
                "precio_base" => $input["precio_base"],
                "cantidad" => $input["cantidad"]
            ]);

            return redirect('/producto')->with('success', 'Producto modificado exitosamente');
        } catch (\Exception $e) {
            return redirect('/producto')->with('error', $e->getMessage());
        }
    }

    public function updateState($id, $estado)
    {

        try {
            Producto::where('id_producto', '=', $id)->update(['estado' => $estado]);

            return redirect('/producto')->with('success', 'Se modificó el estado del producto');
        } catch (\Exception $e) {
            return redirect('/producto')->with('error', $e->getMessage());
        }
    }
}
