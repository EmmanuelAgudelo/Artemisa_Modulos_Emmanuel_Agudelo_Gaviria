<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\FacturaController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->middleware("auth");

// RUTAS DE PRODUCTOS
Route::get('/producto', [ProductoController::class, 'index'])->middleware("auth");
Route::get('/producto/listar', [ProductoController::class, 'listar'])->middleware("auth");
Route::get('/producto/crear', [ProductoController::class, 'crear'])->middleware("auth");
Route::post('/producto/guardar', [ProductoController::class, 'guardar'])->middleware("auth");
Route::get('/producto/editar/{id}', [ProductoController::class, 'editar'])->middleware("auth");
Route::post('/producto/modificar', [ProductoController::class, 'update'])->middleware("auth");
Route::get('/producto/cambiar/estado/{id}/{estado}', [ProductoController::class, 'updateState'])->middleware("auth");

// RUTAS DE CLIENTES

Route::get('/cliente', [ClienteController::class, 'index'])->middleware("auth");
Route::get('/cliente/listar', [ClienteController::class, 'listar'])->middleware("auth");
Route::get('/cliente/crear', [ClienteController::class, 'crear'])->middleware("auth");
Route::post('/cliente/guardar', [ClienteController::class, 'guardar'])->middleware("auth");
Route::get('/cliente/editar/{id}', [ClienteController::class, 'editar'])->middleware("auth");
Route::post('/cliente/modificar', [ClienteController::class, 'update'])->middleware("auth");
Route::get('/cliente/cambiar/estado/{id}/{estado}', [ClienteController::class, 'updateState'])->middleware("auth");

// RUTAS DE EVENTOS

Route::get('/evento', [EventoController::class, 'index'])->middleware("auth");
Route::get('/evento/antiguo', [EventoController::class, 'antiguo'])->middleware("auth");
Route::get('/evento/listar', [EventoController::class, 'listar'])->middleware("auth");
Route::get('/evento/antiguos', [EventoController::class, 'antiguos'])->middleware("auth");
Route::get('/evento/crear', [EventoController::class, 'crear'])->middleware("auth");
Route::post('/evento/guardar', [EventoController::class, 'guardar'])->middleware("auth");
Route::get('/evento/editar/{id}', [EventoController::class, 'editar'])->middleware("auth");
Route::get('/evento/eliminarImagen/{id}', [EventoController::class, 'eliminarImagen'])->middleware("auth");
Route::post('/evento/modificar', [EventoController::class, 'update'])->middleware("auth");
Route::get('/evento/cambiar/estado/{id}/{estado}', [EventoController::class, 'updateState'])->middleware("auth");

// RUTAS DE FACTURAS

Route::get('/factura', [FacturaController::class, 'index'])->middleware("auth");
Route::get('/factura/listar', [FacturaController::class, 'listar'])->middleware("auth");
Route::get('/factura/show', [FacturaController::class, 'show'])->middleware("auth");
Route::get('/factura/detalles', [FacturaController::class, 'detalles'])->middleware("auth");
Route::get('/factura/cambiar/estado/{id}/{estado}', [FacturaController::class, 'updateState'])->middleware("auth");
Route::get('/factura/crear', [FacturaController::class, 'crear'])->middleware("auth");
Route::post('/factura/guardar', [FacturaController::class, 'guardar'])->middleware("auth");
