<?php

namespace App\Http\Middleware;

use App\Models\Administrativo;
use Closure;
use Illuminate\Http\Request;

class AuthAdministrador
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
            if(auth('admin')->user()->TrabajadorTipoTrabajador->tipo_trabajador_id == 3){
                $administrativo = Administrativo::where('trabajador_id',auth('admin')->user()->TrabajadorTipoTrabajador->trabajador_id)->first();
                if($administrativo->AreaAdministrativo->area_id == 3){
                    return $next($request);
                }else{
                    abort(403, 'No tiene autorización.');
                }
            }else{
                if(auth('admin')->user()->TrabajadorTipoTrabajador->tipo_trabajador_id == 2){
                    // return redirect()->route('coordinador.index');
                    abort(403, 'No tiene autorización.');
                }
                if(auth('admin')->user()->TrabajadorTipoTrabajador->tipo_trabajador_id == 1){
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
