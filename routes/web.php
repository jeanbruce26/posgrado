<?php

use Illuminate\Support\Facades\Route;

// // mantenimiento
// Route::get('', [App\Http\Controllers\DashboardController::class, 'mantenimiento'])->name('mantenimiento');
// Route::get('/inscripcion/login', [App\Http\Controllers\DashboardController::class, 'mantenimiento']);
// Route::get('/usuarios/login', [App\Http\Controllers\DashboardController::class, 'mantenimiento']);

// CONTROLADOR DEL LOGIN ADMINISTRADOR
Route::get('login', [App\Http\Controllers\AdminLoginController::class, 'login'])->name('admin.login');
Route::post('logout', [App\Http\Controllers\AdminLoginController::class, 'logout'])->name('admin.logout');

//CONTROLADORES

Route::prefix('administrador')->middleware(['auth:admin','auth.administrador'])->group(function () {
    Route::get('', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('admin.index');
    Route::get('/reporte-dashboard', [App\Http\Controllers\DashboardController::class, 'export_pdf'])->name('admin.export_pdf');
    Route::get('/reporte-evaluaciones', [App\Http\Controllers\DashboardController::class, 'export_evaluaciones_excel'])->name('admin.export_evaluaciones_excel');

    Route::resource ('TipoUbigeo','TipoUbigeoController');
    Route::resource ('TipoDocumento','TipoDocumentoController');
    Route::resource ('GradoAcademico','GradoAcademicoController');
    Route::resource ('Universidad','UniversidadController');
    Route::resource ('EstadoCivil','EstadoCivilController');
    Route::resource ('Discapacidad','DiscapacidadController');

    //Route::resource ('Persona','PersonaController');
    Route::get('/estudiante', [App\Http\Controllers\PersonaController::class, 'index'])->name('admin.persona.index');
    Route::resource ('UbigeoPersona','UbigeoPersonaController');
    
    // Route::resource ('Sede','SedeController');
    Route::get('/sede', [App\Http\Controllers\SedeController::class, 'index'])->name('admin.sede.index');
    Route::get('/programa', [App\Http\Controllers\ProgramaController::class, 'index'])->name('admin.programa.index');
    Route::get('/programa/{id}/cursos', [App\Http\Controllers\ProgramaController::class, 'curso'])->name('admin.programa.curso');
    Route::get('/programa/{id}/grupos', [App\Http\Controllers\ProgramaController::class, 'grupo'])->name('admin.programa.grupo');
    Route::get('/programa/{id}/grupos/{id_grupo_programa}/admitidos', [App\Http\Controllers\ProgramaController::class, 'detalle_grupo'])->name('admin.programa.detalle-grupo');
    Route::get('/plan', [App\Http\Controllers\PlanController::class, 'index'])->name('admin.plan.index');
    Route::get('/admision', [App\Http\Controllers\AdmisionController::class, 'index'])->name('admin.admision.index');
    

    Route::get('/inscripcion', [App\Http\Controllers\InscripcionController::class, 'index'])->name('admin.inscripcion.index');
    Route::get('/evaluaciones', [App\Http\Controllers\InscripcionController::class, 'evaluaciones'])->name('admin.evaluacion.index');
    Route::get('/inscripcion/lista-usuarios', [App\Http\Controllers\InscripcionController::class, 'lista'])->name('admin.inscripcion.lista');
    Route::get('/pago', [App\Http\Controllers\PagoController::class, 'index'])->name('admin.pago.index');
    //Route::resource('CanalPago', 'CanalPagoController');
    Route::get('/canal-pago', [App\Http\Controllers\CanalPagoController::class, 'index'])->name('admin.canal-pago.index');
    Route::get('/inscripcion-pago', [App\Http\Controllers\InscripcionPagoController::class, 'index'])->name('admin.inscripcion-pago.index');
    // Route::resource('ConceptoPago', 'ConceptoPagoController');
    Route::get('/concepto-pago', [App\Http\Controllers\ConceptoPagoController::class, 'index'])->name('admin.concepto-pago.index');

    Route::resource('HistorialInscripcion', 'HistorialInscripcionController');
    Route::resource('ExpedienteInscripcion', 'ExpedienteInscripcionController');
    Route::resource('Expediente', 'ExpedienteController');
    
    Route::get('/trabajador', [App\Http\Controllers\TrabajadorController::class, 'index'])->name('admin.trabajador.index');
    Route::get('/usuario', [App\Http\Controllers\UsuarioTrabajadorController::class, 'index'])->name('admin.user.index');

    Route::get('/admitidos', [App\Http\Controllers\EvaluacionController::class, 'admitidos'])->name('admin.admitidos.index');
    Route::get('/constancia/{admitido}', [App\Http\Controllers\EvaluacionController::class, 'constancia'])->name('admin.admitidos.constancia');

    Route::get('/perfil', [App\Http\Controllers\TrabajadorController::class, 'perfil'])->name('admin.perfil.index');

    Route::get('/encuestas', [App\Http\Controllers\EncuestaController::class, 'index'])->name('admin.encuesta.index');
});


//CONTROLADOR DEL MODULO DE COORDINADORES
Route::prefix('coordinador')->middleware(['auth:admin','auth.coordinador'])->group(function () {
    Route::get('/index', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'index'])->name('coordinador.index');
    Route::get('/{id}/inscripciones', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'inscripciones'])->name('coordinador.inscripciones');
    Route::get('/evaluacion/{id}/expediente/{tipo}', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'expediente'])->name('coordinador.expediente');
    Route::get('/evaluacion/{id}/entrevista/{tipo}', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'entrevista'])->name('coordinador.entrevista');
    Route::get('/evaluacion/{id}/investigacion/{tipo}', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'investigacion'])->name('coordinador.investigacion');
    Route::get('/reportes/{id}/maestria', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'reportes_maestria'])->name('coordinador.reportes.maestria');
    Route::get('/reportes/{id}/doctorado', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'reportes_doctorado'])->name('coordinador.reportes.doctorado');
    Route::get('/perfil', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'perfil'])->name('coordinador.perfil.index');
    Route::get('/inscripciones', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'modulo_inscripcion_index'])->name('coordinador.modulo-inscripcion-index.index');
    Route::get('/inscripciones/{id}', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'modulo_inscripcion'])->name('coordinador.modulo-inscripcion.index');
    Route::get('/matriculados', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'matriculados'])->name('coordinador.matriculados.index');
});

// docentes de coordinadores para la evaluacion
// Route::get('/evaluacion/login', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'auth'])->name('coordinador.auth.index');
// Route::post('/evaluacion/logout', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'logout'])->name('coordinador.auth.logout');

// Route::prefix('evaluacion')->middleware(['auth.evaluacion.vista.docente'])->group(function () {
//     Route::get('/programas', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'programas'])->name('coordinador.docente.programas.index');
//     Route::get('/programas/{id}/inscripciones', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'programas_inscripciones'])->name('coordinador.docente.programas.inscripciones.index');
//     Route::get('/programas/{id}/investigacion/{tipo}', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'programas_investigacion'])->name('coordinador.evaluacion-docente.investigacion');
//     Route::get('/programas/{id}/entrevista/{tipo}', [App\Http\Controllers\ModuloCoordinador\CoordinadorController::class, 'programas_entrevista'])->name('coordinador.evaluacion-docente.entrevista');
// });


//CONTROLADOR DEL MODULO DEL AREA CONTABLE
Route::prefix('contable')->middleware(['auth:admin','auth.contable'])->group(function () {
    Route::get('/index', [App\Http\Controllers\ModuloContable\ContableController::class, 'index'])->name('contable.index');
    Route::get('/inscripciones', [App\Http\Controllers\ModuloContable\ContableController::class, 'inscripciones'])->name('contable.inscripcion');
    Route::get('/pagos', [App\Http\Controllers\ModuloContable\ContableController::class, 'pagos'])->name('contable.pagos');
});


//RUTA ERRORS
Route::get('errorLogin', function(){
    return view('modulo_inscripcion.errors.errorLogin');
});


//RUTAS DE LA PARTE DE INSCRIPCION DE USUARIOS
Route::get('inscripcion', [App\Http\Controllers\ModuloInscripcion\Inscripcion\UserInscripcionController::class, 'index'])->middleware('auth.pagos','pagos.estado')->name('inscripcion');
Route::get('inscripcion/pagos', [App\Http\Controllers\ModuloInscripcion\Inscripcion\UserInscripcionController::class, 'index2'])->middleware('auth.pagos','pagos.estado')->name('inscripcion.pagos');
Route::get('inscripcion/inscripcion/{id}', [App\Http\Controllers\ModuloInscripcion\Inscripcion\UserInscripcionController::class, 'inscripcion'])->middleware('auth.pagos')->name('inscripcion.inscripcion');
Route::get('inscripcion/pdf/{id}', [App\Http\Controllers\ModuloInscripcion\Inscripcion\UserInscripcionController::class, 'pdf'])->middleware('auth.pagos')->name('usuario-pdf');
Route::get('inscripcion/gracias/{id}', [App\Http\Controllers\ModuloInscripcion\Inscripcion\UserInscripcionController::class, 'gracias'])->name('inscripcion.gracias');
Route::get('inscripcion/login', [App\Http\Controllers\ModuloInscripcion\Inscripcion\InscripcionLoginController::class, 'index'])->middleware('insc')->name('usuario.login');
Route::post('inscripcion/logout', [App\Http\Controllers\ModuloInscripcion\Inscripcion\InscripcionLoginController::class, 'logout'])->name('usuario.logout');


//RUTAS DE LOS USUARIOS PARA QUE SUBAN SUS EXPEDIENTES FALTANTES
Route::get('usuarios/login', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioLoginController::class, 'index'])->name('usuario.usuario.login');
Route::post('usuarios/logout', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioLoginController::class, 'logout'])->name('usuario.usuario.logout');
Route::prefix('usuarios')->middleware(['auth.usuarios'])->group(function () {
    Route::get('/', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioController::class, 'index'])->middleware('auth.usuarios')->name('usuarios.index');
    Route::get('/documentos', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioController::class, 'edit'])->middleware('auth.usuarios')->name('usuarios.edit');
    Route::get('/pagos', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioController::class, 'pagos'])->middleware('auth.usuario.admitido')->name('usuarios.pagos');
    Route::get('/pdf', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioController::class, 'pdf'])->name('usuarios.pdf');
});
Route::get('usuarios/ficha-inscripcion', [App\Http\Controllers\ModuloInscripcion\Usuario\UsuarioController::class, 'ficha_inscripcion'])->name('usuarios.ficha-inscripcion');



//SUPER ADMIN
//password => super-admin