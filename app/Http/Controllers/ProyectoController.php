<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Muestra la lista de todos los proyectos con su cliente asociado.
     */
    public function index()
    {
        $proyectos = Proyecto::with('cliente')->latest()->paginate(5);
        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Muestra el formulario para crear un nuevo proyecto.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('proyectos.create', compact('clientes'));
    }

    /**
     * Valida y guarda un nuevo proyecto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'descripcion'  => 'nullable|string',
            'estado'       => 'required|in:pendiente,en progreso,completado',
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'nullable|date|after_or_equal:fecha_inicio',
            'cliente_id'   => 'required|exists:clientes,id',
        ]);

        Proyecto::create($request->all());
        return redirect()->route('proyectos.index')->with('success', 'Proyecto registrado correctamente.');
    }

    /**
     * Muestra el detalle de un proyecto específico con su cliente.
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::with('cliente')->findOrFail($id);
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Muestra el formulario para editar un proyecto existente.
     */
    public function edit(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $clientes = Cliente::all();
        return view('proyectos.edit', compact('proyecto', 'clientes'));
    }

    /**
     * Valida y actualiza un proyecto en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        $proyecto = Proyecto::findOrFail($id);

        $request->validate([
            'nombre'       => 'required|string|max:255',
            'descripcion'  => 'nullable|string',
            'estado'       => 'required|in:pendiente,en progreso,completado',
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'nullable|date|after_or_equal:fecha_inicio',
            'cliente_id'   => 'required|exists:clientes,id',
        ]);

        $proyecto->update($request->all());
        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    /**
     * Elimina un proyecto de la base de datos.
     */
    public function destroy(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado correctamente.');
    }
}
