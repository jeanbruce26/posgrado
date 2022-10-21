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

//RUTA ERRORS
Route::get('errorLogin', function(){
    return view('usuario.errors.errorLogin');
});

//RUTAS DE LA PARTE DE INSCRIPCION DE USUARIOS
Route::get('inscripcion', [App\Http\Controllers\ModuloInscripcion\Inscripcion\UserInscripcionController::class, 'index'])->middleware('auth.pagos','pagos.estado')->name('inscripcion');
Route::get('inscripcion/pagos', [App\Http\Controllers\ModuloInscripcion\Inscripcion\UserInscripcionController::class, 'index2'])->middleware('auth.pagos','pagos.estado')->name('inscripcion.pagos');
Route::get('inscripcion/inscripcion/{id}', [App\Http\Controllers\ModuloInscripcion\Inscripcion\UserInscripcionController::class, 'inscripcion'])->middleware('auth.pagos')->name('inscripcion.inscripcion');
Route::get('inscripcion/pdf/{id}', [App\Http\Controllers\ModuloInscripcion\Inscripcion\UserInscripcionController::class, 'pdf'])->middleware('auth.pagos')->name('usuario-pdf');

Route::get('inscripcion/login', [App\Http\Controllers\ModuloInscripcion\Inscripcion\InscripcionLoginController::class, 'index'])->middleware('insc')->name('usuario.login');
Route::post('inscripcion/logout', [App\Http\Controllers\ModuloInscripcion\Inscripcion\InscripcionLoginController::class, 'logout'])->name('usuario.logout');

//RUTAS DE LOS USUARIOS PARA QUE SUBAN SUS EXPEDIENTES FALTANTES
Route::get('usuarios/login', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioLoginController::class, 'index'])->name('usuario.usuario.login');
Route::post('usuarios/logout', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioLoginController::class, 'logout'])->name('usuario.usuario.logout');

Route::get('usuarios', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioController::class, 'index'])->middleware('auth.usuarios')->name('usuarios.index');
Route::get('usuarios/documentos', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioController::class, 'edit'])->middleware('auth.usuarios')->name('usuarios.edit');
Route::get('usuarios/pdf/{id}', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioController::class, 'pdf'])->middleware('auth:usuarios')->name('usuario.pdf');

