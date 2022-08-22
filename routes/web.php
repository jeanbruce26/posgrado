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
Route::resource('Expediente', 'ExpedienteController');

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

Route::get('inscripcion', 'UserInscripcionController@index4')->name('inscripcion')->middleware('auth:pagos');

Route::get('inscripcion', 'UserInscripcionController@index')->middleware('auth:pagos','pagos.estado')->name('inscripcion');
Route::post('inscripcion', 'UserInscripcionController@check')->middleware('auth:pagos','pagos.estado')->name('check');
Route::get('inscripcion/pagos', 'UserInscripcionController@index2')->middleware('auth:pagos','pagos.estado')->name('inscripcion.pagos');
Route::post('inscripcion/pagos', 'UserInscripcionController@mostrarPago')->middleware('auth:pagos','pagos.estado')->name('inscripcion.mostrar-pagos');
Route::post('inscripcion/guardar-pagos', 'UserInscripcionController@guardarPago')->middleware('auth:pagos','pagos.estado')->name('inscripcion.guardar-pagos');
Route::get('inscripcion/inscripcion/{id_inscripcion}', 'UserInscripcionController@inscripcion')->middleware('auth:pagos')->name('inscripcion.inscripcion');
Route::post('inscripcion/inscripcion', 'UserInscripcionController@store')->name('inscripcion.store');

Route::get('inscripcion/login', 'InscripcionLoginController@index')->name('login');
Route::post('inscripcion/login', 'InscripcionLoginController@store')->name('login.store');
Route::post('inscripcion/logout', 'InscripcionLoginController@logout')->name('logout');

