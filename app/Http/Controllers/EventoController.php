<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class EventoController extends Controller
{
    public function index()
    {
        return view('evento.index');
    }

    public function antiguo()
    {
        return view('evento.antiguos');
    }

    public function listar(Request $request)
    {
        $eventos = Evento::all();


        return DataTables::of($eventos)
            ->editColumn("imagen", function ($evento) {
                if ($evento->imagen == null) {
                    return 'Sin imagen <i class="fas fa-image"></i>';
                } else {
                    return "<img src='uploads/" . $evento->imagen . "' width= '80px' > ";
                }
            })
            ->addColumn("estado", function ($evento) {
                if ($evento->estado == 1) {
                    return '<span class="badge bg-success">Activo</span>';
                } else {
                    return '<span class="badge bg-danger">Inactivo</span>';
                }
            })
            ->addColumn("acciones", function ($evento) {

                if ($evento->estado == 1) {
                    if ($evento->imagen != null) {
                        return '<a class="btn btn-primary me-2" href="/evento/editar/' . $evento->id . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-danger me-2" href="/evento/cambiar/estado/' . $evento->id . '/0"><i class="fas fa-ban"></i></a>' . '<a class="btn btn-danger" href="/evento/eliminarImagen/' . $evento->id . '"><i class="fas fa-file-image"></i></a>';
                    } else {
                        return '<a class="btn btn-primary me-2" href="/evento/editar/' . $evento->id . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-danger" href="/evento/cambiar/estado/' . $evento->id . '/0"><i class="fas fa-ban"></i></a>';
                    }
                } else {
                    if ($evento->imagen != null) {
                        return '<a class="btn btn-primary me-2" href="/evento/editar/' . $evento->id . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-success me-2" href="/evento/cambiar/estado/' . $evento->id . '/1"><i class="fas fa-check"></i></a>' . '<a class="btn btn-danger" href="/evento/eliminarImagen/' . $evento->id . '"><i class="fas fa-file-image"></i></a>';
                    } else {
                        return '<a class="btn btn-primary me-2" href="/evento/editar/' . $evento->id . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-success" href="/evento/cambiar/estado/' . $evento->id . '/1"><i class="fas fa-check"></i></a>';
                    }
                }
            })
            ->rawColumns(['estado', 'acciones', 'imagen'])
            ->make(true);
    }

    public function antiguos(Request $request)
    {
        $eventos = Evento::all();

        return DataTables::of($eventos)
            ->editColumn("imagen", function ($evento) {
                if ($evento->imagen == null) {
                    return 'Sin imagen <i class="fas fa-image"></i>';
                } else {
                    return "<img src='uploads/" . $evento->imagen . "' width= '80px' > ";
                }
            })
            ->addColumn("estado", function ($evento) {
                if ($evento->estado == 1) {
                    return '<span class="badge bg-success">Activo</span>';
                } else {
                    return '<span class="badge bg-danger">Inactivo</span>';
                }
            })
            ->addColumn("acciones", function ($evento) {

                if ($evento->estado == 1) {
                    if ($evento->imagen != null) {
                        return '<a class="btn btn-primary me-2" href="/evento/editar/' . $evento->id . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-danger me-2" href="/evento/cambiar/estado/' . $evento->id . '/0"><i class="fas fa-ban"></i></a>' . '<a class="btn btn-danger" href="/evento/eliminarImagen/' . $evento->id . '"><i class="fas fa-file-image"></i></a>';
                    } else {
                        return '<a class="btn btn-primary me-2" href="/evento/editar/' . $evento->id . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-danger" href="/evento/cambiar/estado/' . $evento->id . '/0"><i class="fas fa-ban"></i></a>';
                    }
                } else {
                    if ($evento->imagen != null) {
                        return '<a class="btn btn-primary me-2" href="/evento/editar/' . $evento->id . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-success me-2" href="/evento/cambiar/estado/' . $evento->id . '/1"><i class="fas fa-check"></i></a>' . '<a class="btn btn-danger" href="/evento/eliminarImagen/' . $evento->id . '"><i class="fas fa-file-image"></i></a>';
                    } else {
                        return '<a class="btn btn-primary me-2" href="/evento/editar/' . $evento->id . '"><i class="fas fa-pen "></i></a>' . '<a class="btn btn-success" href="/evento/cambiar/estado/' . $evento->id . '/1"><i class="fas fa-check"></i></a>';
                    }
                }
            })
            ->rawColumns(['estado', 'acciones', 'imagen'])
            ->make(true);
    }

    public function crear()
    {
        return view('evento.crear');
    }

    public function guardar(Request $request)
    {

        $request->validate(Evento::$rules);
        $input = $request->all();
        try {
            $imagen = null;
            if ($request->imagen != null) {
                $imagen = $input["nombre"] . '.' . time() . '.' . $request->imagen->extension();
                $request->imagen->move(public_path('uploads'), $imagen);
            }

            Evento::create([

                "nombre" => $input["nombre"],
                "descripcion" => $input["descripcion"],
                "valor_decoracion" => $input["valor_decoracion"],
                "valor_entrada" => $input["valor_entrada"],
                "estado" => 1,
                "inicio" => $input["inicio"],
                "fin" => $input["fin"],
                "imagen" => $imagen
            ]);
            return redirect('/evento')->with('success', 'Evento creado exitosa');
        } catch (\Exception $e) {
            return redirect('/evento')->with('error', 'El evento ya existe');
        }
    }

    public function editar($id)
    {
        $evento = Evento::find($id);

        if ($evento == null) {
            return redirect('/evento')->with('error', 'Evento no encontrado');
        }

        return view("evento.editar", compact("evento"));
    }


    public function update(Request $request)
    {

        $request->validate(Evento::$rules);
        $input = $request->all();

        try {
            $evento = Evento::find($input["id"]);



            if ($evento == null) {
                return redirect('/evento')->with('error', 'Evento no encontrado');
            }
            $imagen = null;
            if ($request->imagen != null) {
                $imagen = $input["nombre"] . '.' . time() . '.' . $request->imagen->extension();
                $request->imagen->move(public_path('uploads'), $imagen);
            } else {
                $imagen =  $evento->imagen;
            }

            $evento->update([
                "nombre" => $input["nombre"],
                "descripcion" => $input["descripcion"],
                "valor_decoracion" => $input["valor_decoracion"],
                "valor_entrada" => $input["valor_entrada"],
                "inicio" => $input["inicio"],
                "fin" => $input["fin"],
                "imagen" => $imagen
            ]);
            return redirect('/evento')->with('success', 'Evento modificado exitosamente');
        } catch (\Exception $e) {
            return redirect('/evento')->with('error', $e->getMessage());
        }
    }

    public function updateState($id, $estado)
    {

        try {
            Evento::where('id', '=', $id)->update(['estado' => $estado]);

            return redirect('/evento')->with('success', 'Se modificó el estado del evento');
        } catch (\Exception $e) {
            return redirect('/evento')->with('error', $e->getMessage());
        }
    }

    public function eliminarImagen($id)
    {

        try {
            Evento::where('id', '=', $id)->update(['imagen' => null]);

            return redirect('/evento')->with('success', 'Se eliminó la imagen del evento evento');
        } catch (\Exception $e) {
            return redirect('/evento')->with('error', $e->getMessage());
        }
    }
}
