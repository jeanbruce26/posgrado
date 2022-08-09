<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin');
});

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
Route::resource ('Mencion', 'MencionController');
Route::resource ('SubPrograma', 'SubProgramaController');

Route::resource('Admision', 'AdmisionController');
Route::resource('Inscripcion', 'InscripcionController');
Route::resource('Pago', 'PagoController');
Route::resource('CanalPago', 'CanalPagoController');
Route::resource('InscripcionPago', 'InscripcionPagoController');
Route::resource('ConceptoPago', 'ConceptoPagoController');
Route::resource('HistorialInscripcion', 'HistorialInscripcionController');
Route::resource('ExpedienteInscripcion', 'ExpedienteInscripcionController');

Route::get('/user', function () {
    return view('user');
});

Route::get('user', 'UserInscripcionController@index4')->name('user');
Route::get('user/inscripcion', 'UserInscripcionController@index');
Route::post('user/inscripcion', 'UserInscripcionController@store')->name('inscripcion.store1');
Route::get('user/inscripcion/paso2/{idpersona}', 'UserInscripcionController@index2')->name('inscripcion.index2');
Route::post('user/inscripcion/paso2', 'UserInscripcionController@store2')->name('inscripcion.store2');
Route::get('user/inscripcion/paso3/{id_inscripcion}', 'UserInscripcionController@index3')->name('inscripcion.index3');
Route::post('user/inscripcion/paso3', 'UserInscripcionController@store3')->name('inscripcion.store3');
