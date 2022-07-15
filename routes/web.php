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
    return view('admin');
});

Route::resource ('Ubigeo','UbigeoController');
Route::resource ('TipoUbigeo','TipoUbigeoController');

Route::resource ('TipoDocumento','TipoDocumentoController');
Route::resource ('GradoAcademico','GradoAcademicoController');
Route::resource ('Universidad','UniversidadController');
Route::resource ('EstadoCivil','EstadoCivilController');
Route::resource ('Discapacidad','DiscapacidadController');
Route::resource ('Persona','PersonaController');
Route::resource ('UbigeoPersona','UbigeoPersonaController');

Route::resource ('Sede','SedeController');
Route::resource ('Programa','ProgramaController');
Route::resource ('Plan','PlanController');
Route::get ('DetallePrograma', [App\Http\Controllers\DetalleProgramaController::class, 'index']);

Route::resource('Admision', 'AdmisionController');
Route::resource('Inscripcion', 'InscripcionController');
Route::resource('Pago', 'PagoController');
Route::resource('TipoPago', 'TipoPagoController');
Route::resource('IngresoPago', 'IngresoPagoController');
Route::resource('InscripcionPago', 'InscripcionPagoController');
Route::resource('ConceptoPago', 'ConceptoPagoController');
Route::resource('HistorialInscripcion', 'HistorialInscripcionController');
Route::resource('ExpedienteInscripcion', 'ExpedienteInscripcionController');

