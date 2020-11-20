<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();
//cargo
Route::get('/cargo', [App\Http\Controllers\CargoController::class, 'index'])->name('cargo.index');
Route::post('cargo', [App\Http\Controllers\CargoController::class, 'registrar'])->name('cargo.registrar');
Route::get('cargo/eliminar/{id}', [App\Http\Controllers\CargoController::class, 'eliminar'])->name('cargo.eliminar');
Route::get('cargo/editar/{id}',  [App\Http\Controllers\CargoController::class, 'editar'])->name('cargo.editar');
Route::post('cargo/actualizar',  [App\Http\Controllers\CargoController::class, 'actualizar'])->name('cargo.actualizar');
//cargofin
//lugar
Route::get('/lugar', [App\Http\Controllers\LugarController::class, 'index'])->name('lugar.index'); 
Route::post('lugar', [App\Http\Controllers\LugarController::class, 'registrar'])->name('lugar.registrar');
Route::get('lugar/eliminar/{id}', [App\Http\Controllers\LugarController::class, 'eliminar'])->name('lugar.eliminar');
Route::get('lugar/editar/{id}',  [App\Http\Controllers\LugarController::class, 'editar'])->name('lugar.editar');
Route::post('lugar/actualizar',  [App\Http\Controllers\LugarController::class, 'actualizar'])->name('lugar.actualizar');
//lugarfin
//restriccion
Route::get('/restriccion', [App\Http\Controllers\RestriccionController::class, 'index'])->name('restriccion.index');
Route::post('restriccion', [App\Http\Controllers\RestriccionController::class, 'registrar'])->name('restriccion.registrar');
Route::get('restriccion/eliminar/{id}', [App\Http\Controllers\RestriccionController::class, 'eliminar'])->name('restriccion.eliminar');
Route::get('restriccion/editar/{id}',  [App\Http\Controllers\RestriccionController::class, 'editar'])->name('restriccion.editar');
Route::post('restriccion/actualizar',  [App\Http\Controllers\RestriccionController::class, 'actualizar'])->name('restriccion.actualizar');
//restriccionfin
//empleado
Route::get('/empleado', [App\Http\Controllers\EmpleadoController::class, 'index'])->name('empleado.index');
Route::post('empleado', [App\Http\Controllers\EmpleadoController::class, 'registrar'])->name('empleado.registrar');
Route::get('empleado/eliminar/{id}', [App\Http\Controllers\EmpleadoController::class, 'eliminar'])->name('empleado.eliminar');
Route::get('empleado/edit/{id}',  [App\Http\Controllers\EmpleadoController::class, 'editar'])->name('empleado.editar');
Route::post('empleado/actualizar',  [App\Http\Controllers\EmpleadoController::class, 'actualizar'])->name('empleado.actualizar');
//empleadofin

Route::get('/empleadoimg', [App\Http\Controllers\EmpleadoimgController::class, 'index'])->name('empleadoimg.index');
Route::get('/empleadoimg/create', [App\Http\Controllers\EmpleadoimgController::class, 'create'])->name('empleadoimg.create');
Route::post('/empleadoimg', [App\Http\Controllers\EmpleadoimgController::class, 'store'])->name('empleadoimg.store');
Route::get('/empleadoimg/edit/{id}',  [App\Http\Controllers\EmpleadoimgController::class, 'edit'])->name('empleadoimg.edit');
Route::patch('/empleadoimg/{id}',  [App\Http\Controllers\EmpleadoimgController::class, 'update'])->name('empleadoimg.update');
Route::delete('/empleadoimg/{id}', [App\Http\Controllers\EmpleadoimgController::class, 'destroy'])->name('empleadoimg.destroy');

//lugarrestriccion

//lugarrestriccionfin
//lugarrestriccion
Route::get('/lugarrestriccion', [App\Http\Controllers\LugarrestriccionController::class, 'index'])->name('lugarrestriccion.index');
Route::post('lugarrestriccion', [App\Http\Controllers\LugarrestriccionController::class, 'registrar'])->name('lugarrestriccion.registrar');
Route::get('lugarrestriccion/eliminar/{id}', [App\Http\Controllers\LugarrestriccionController::class, 'eliminar'])->name('lugarrestriccion.eliminar');
Route::get('lugarrestriccion/editar/{id}',  [App\Http\Controllers\LugarrestriccionController::class, 'editar'])->name('lugarrestriccion.editar');
Route::post('lugarrestriccion/actualizar',  [App\Http\Controllers\LugarrestriccionController::class, 'actualizar'])->name('lugarrestriccion.actualizar');
//lugarrestriccionfin
//
Route::get('/restriccionempleado', [App\Http\Controllers\RestriccionempleadoController::class, 'index'])->name('restriccionempleado.index');
Route::post('restriccionempleado', [App\Http\Controllers\RestriccionempleadoController::class, 'registrar'])->name('restriccionempleado.registrar');
Route::get('restriccionempleado/eliminar/{id}', [App\Http\Controllers\RestriccionempleadoController::class, 'eliminar'])->name('restriccionempleado.eliminar');
Route::get('restriccionempleado/editar/{id}',  [App\Http\Controllers\RestriccionempleadoController::class, 'editar'])->name('restriccionempleado.editar');
Route::post('restriccionempleado/actualizar',  [App\Http\Controllers\RestriccionempleadoController::class, 'actualizar'])->name('restriccionempleado.actualizar');
//
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');