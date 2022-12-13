<?php

namespace App\Http\Controllers;

use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $plan = Plan::all();
        return view('modulo_administrador.Plan.index', compact('plan'));
    }
}
