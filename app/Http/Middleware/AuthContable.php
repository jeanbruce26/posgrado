<?php

namespace App\Http\Middleware;

use App\Models\Administrativo;
use App\Models\AreaAdministrativo;
use App\Models\Trabajador;
use Closure;
use Illuminate\Http\Request;

class AuthContable
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
                $trabajador_id = auth('admin')->user()->TrabajadorTipoTrabajador->trabajador_id;
                $trabajador = Trabajador::find($trabajador_id);
                $administrativo = Administrativo::where('trabajador_id', $trabajador->id)->first();
                if($administrativo){
                    if($administrativo->area_id != 1){
                        abort(403, 'No tiene autorización.');
                    }else{
                        return $next($request);
                    }
                }
            }else{
                if(auth('admin')->user()->TrabajadorTipoTrabajador->tipo_trabajador_id == 1){
                    abort(403, 'No tiene autorización.');
                }
                if(auth('admin')->user()->TrabajadorTipoTrabajador->tipo_trabajador_id == 2){
                    abort(403, 'No tiene autorización.');
                }
                if(auth('admin')->user()->TrabajadorTipoTrabajador->tipo_trabajador_id == 4){
                    abort(403, 'No tiene autorización.');
                }
            }
        }else{
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
