<?php

use Illuminate\Support\Facades\Route;

// CONTROLADOR DEL LOGIN ADMINISTRADOR
Route::get('login', [App\Http\Controllers\AdminLoginController::class, 'login'])->name('admin.login');
Route::post('logout', [App\Http\Controllers\AdminLoginController::class, 'logout'])->name('admin.logout');

//CONTROLADORES
Route::get('', [App\Http\Controllers\AdminLoginController::class, 'administrador'])->middleware('auth:admin','auth.administrador')->name('admin.index');

Route::resource ('TipoUbigeo','TipoUbigeoController')->middleware('auth:admin','auth.administrador');

Route::resource ('TipoDocumento','TipoDocumentoController')->middleware('auth:admin','auth.administrador');
Route::resource ('GradoAcademico','GradoAcademicoController')->middleware('auth:admin','auth.administrador');
Route::resource ('Universidad','UniversidadController')->middleware('auth:admin','auth.administrador');
Route::resource ('EstadoCivil','EstadoCivilController')->middleware('auth:admin','auth.administrador');
Route::resource ('Discapacidad','DiscapacidadController')->middleware('auth:admin','auth.administrador');
Route::resource ('Persona','PersonaController')->middleware('auth:admin','auth.administrador');
Route::resource ('UbigeoPersona','UbigeoPersonaController')->middleware('auth:admin','auth.administrador');

Route::resource ('Sede','SedeController')->middleware('auth:admin','auth.administrador');
Route::resource ('Programa','ProgramaController')->middleware('auth:admin','auth.administrador');
Route::resource ('Plan','PlanController')->middleware('auth:admin');
Route::resource ('Mencion', 'MencionController')->middleware('auth:admin','auth.administrador');
Route::resource ('SubPrograma', 'SubProgramaController')->middleware('auth:admin','auth.administrador');

Route::resource('Admision', 'AdmisionController')->middleware('auth:admin','auth.administrador');
Route::resource('Inscripcion', 'InscripcionController')->middleware('auth:admin','auth.administrador');
Route::resource('Pago', 'PagoController')->middleware('auth:admin','auth.administrador');
Route::resource('CanalPago', 'CanalPagoController')->middleware('auth:admin','auth.administrador');
Route::resource('InscripcionPago', 'InscripcionPagoController')->middleware('auth:admin','auth.administrador');
Route::resource('ConceptoPago', 'ConceptoPagoController')->middleware('auth:admin','auth.administrador');
Route::resource('HistorialInscripcion', 'HistorialInscripcionController')->middleware('auth:admin','auth.administrador');
Route::resource('ExpedienteInscripcion', 'ExpedienteInscripcionController')->middleware('auth:admin','auth.administrador');
Route::resource('Expediente', 'ExpedienteController')->middleware('auth:admin','auth.administrador');

Route::get('administrador/coordinador', [App\Http\Controllers\CoordinadorController::class, 'index'])->middleware('auth:admin','auth.administrador')->name('admin.coordinador.index');


//CONTROLADOR DEL MODULO DE COORDINADORES
Route::get('coordinador/index', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'index'])->middleware('auth:admin','auth.coordinador')->name('coordinador.index');


//RUTA ERRORS
Route::get('errorLogin', function(){
    return view('modulo_inscripcion.errors.errorLogin');
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


//SUPER ADMIN
//password => super-admin