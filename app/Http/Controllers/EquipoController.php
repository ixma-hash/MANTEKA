<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Equipo;
use App\Models\Cliente;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Equipos/Index', [
            'equipos' => Equipo::with('cliente')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Equipos/Create', [
            'clientes' => Cliente::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'marca' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'numero_serie' => 'nullable|string|max:255',
            'propiedad' => 'required|string|max:255',
            'f_ingreso' => 'required|string|max:255',
            'f_entrega' => 'nullable|string|max:255',
        ]);

        Equipo::create($validated);

        return to_route('equipos.index')->with('success', 'Equipo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $equipo = Equipo::findOrFail($id);

        return Inertia::render('Equipos/Edit', [
            'equipo' => $equipo,
            'clientes' => Cliente::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equipo = Equipo::findOrFail($id);

        $validated = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'marca' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'numero_serie' => 'nullable|string|max:255',
            'propiedad' => 'required|string|max:255',
            'f_ingreso' => 'required|string|max:255',
            'f_entrega' => 'nullable|string|max:255',
        ]);

        $equipo->update($validated);

        return to_route('equipos.index')->with('success', 'Equipo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Equipo::findOrFail($id)->delete();

        return to_route('equipos.index');
    }
}
