<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Equipo;
use App\Models\Cliente;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Dashboard', [
            'equipos' => Equipo::all(),
            'clientes' => Cliente::all(),
        ]);
    }
}
