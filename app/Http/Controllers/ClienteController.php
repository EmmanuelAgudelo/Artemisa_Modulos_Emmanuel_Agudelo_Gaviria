<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClienteController extends Controller
{
    public function index()
    {
        return view('cliente.index');
    }


    public function listar()
    {
        $clientes = Cliente::all();

        return DataTables::of($clientes)
            ->addColumn("estado", function ($cliente) {
                if ($cliente->estado == 1) {
                    return '<span class="badge bg-success">Activo</span>';
                } else {
                    return '<span class="badge bg-danger">Inactivo</span>';
                }
            })
            ->addColumn("acciones", function ($cliente) {

                if ($cliente->estado == 1) {
                    return '<a class="btn btn-primary me-2" href="/cliente/editar/' . $cliente->id . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-danger" href="/cliente/cambiar/estado/' . $cliente->id . '/0"><i class="fas fa-user-slash"></i></a>';
                } else {
                    return '<a class="btn btn-primary me-2" href="/cliente/editar/' . $cliente->id . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-success" href="/cliente/cambiar/estado/' . $cliente->id . '/1"><i class="fas fa-user-check"></i></a>';
                }
            })
            ->rawColumns(['estado', 'acciones'])
            ->make(true);
    }

    public function crear()
    {
        return view('cliente.crear');
    }

    public function guardar(Request $request)
    {
        $request->validate(Cliente::$rules);
        $input = $request->all();

        try {
            Cliente::create([
                "nombre" => $input["nombre"],
                "apellidos" => $input["apellidos"],
                "documento" => $input["documento"],
                "telefono" => $input["telefono"],
                "email" => $input["email"],
                "estado" => 1
            ]);

            return redirect('/cliente')->with('success', 'Cliente creado exitosamente');
        } catch (\Exception $e) {
            return redirect('/cliente')->with('error', "El cliente ya existe");
        }
    }


    public function editar($id)
    {

        $cliente = Cliente::find($id);

        if ($cliente == null) {
            return redirect('/cliente')->with('error', 'Cliente no encontrado');
        }

        return view("cliente.editar", compact("cliente"));
    }

    public function update(Request $request)
    {
        $request->validate(Cliente::$rules);
        $input = $request->all();

        try {
            $cliente = Cliente::find($input["id"]);

            if ($cliente == null) {
                return redirect('/cliente')->with('error', 'Cliente no encontrado');
            }

            $cliente->update([
                "nombre" => $input["nombre"],
                "apellidos" => $input["apellidos"],
                "documento" => $input["documento"],
                "telefono" => $input["telefono"],
                "email" => $input["email"],
            ]);

            return redirect('/cliente')->with('success', 'Cliente modificado exitosamente');
        } catch (\Exception $e) {
            return redirect('/cliente')->with('error', $e->getMessage());
        }
    }

    public function updateState($id, $estado)
    {
        try {
            Cliente::where('id', '=', $id)->update(['estado' => $estado]);

            return redirect('/cliente')->with('success', 'Se modificó el estado del cliente');
        } catch (\Exception $e) {
            return redirect('/cliente')->with('error', $e->getMessage());
        }
    }
}
