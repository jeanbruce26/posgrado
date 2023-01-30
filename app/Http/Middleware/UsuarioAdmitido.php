<?php

namespace App\Http\Middleware;

use App\Models\Admitidos;
use App\Models\Evaluacion;
use Closure;
use Illuminate\Http\Request;

class UsuarioAdmitido
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $evaluacion = Evaluacion::where('inscripcion_id', auth('usuarios')->user()->id_inscripcion)->first();
        if ($evaluacion) {
            $admitido = Admitidos::where('evaluacion_id', $evaluacion->evaluacion_id)->first();
            if ($admitido) {
                return $next($request);
            } else {
                abort(403, 'No tiene autorización.');
            }
        }else{
            abort(403, 'No tiene autorización.');
        }
        
        return $next($request);
    }
}
