<?php

namespace App\Http\Middleware;

use App\Models\Admision;
use Closure;
use Illuminate\Http\Request;

class CheckInsc
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
        $admision = Admision::where('estado', 1)->first();
        if($admision->fecha_fin < today()){
            return redirect('errorLogin');
        }else{
            return $next($request);
        }
        
    }
}
