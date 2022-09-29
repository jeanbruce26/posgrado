<?php

namespace App\Http\Middleware;

use App\Models\InscripcionPago;
use Closure;
use Illuminate\Http\Request;

class EstadoPago
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
        $ins_pag = InscripcionPago::where('pago_id',auth('pagos')->user()->pago_id)->first();           
        if (auth('pagos')->user() &&  auth('pagos')->user()->estado == 1) {
            return $next($request);
        }
        return redirect('inscripcion/inscripcion/'.$ins_pag->inscripcion_id);
    }
}
