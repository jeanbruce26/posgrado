<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCoordinador
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
        if (Auth('admin')->Check()) {
            if(auth('admin')->user()->TrabajadorTipoTrabajador->tipo_trabajador_id == 2){
                return $next($request);
            }else{
                if(auth('admin')->user()->TrabajadorTipoTrabajador->tipo_trabajador_id == 1){
                    // return redirect()->route('coordinador.index');
                    abort(403, 'No tiene autorización.');
                }
                if(auth('admin')->user()->TrabajadorTipoTrabajador->tipo_trabajador_id == 3){
                    // return redirect()->route('coordinador.index');
                    abort(403, 'No tiene autorización.');
                }
                if(auth('admin')->user()->TrabajadorTipoTrabajador->tipo_trabajador_id == 4){
                    // return redirect()->route('coordinador.index');
                    abort(403, 'No tiene autorización.');
                }
            }
        }else{
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
