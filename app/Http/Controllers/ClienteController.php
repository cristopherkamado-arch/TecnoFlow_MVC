<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Muestra la lista de todos los clientes.
     */
    public function index()
    {
        $clientes       = Cliente::latest()->paginate(5);
        $totalClientes  = Cliente::count();
        $totalEmpresas  = Cliente::where('tipo_cliente', 'empresa')->count();
        $totalPersonas  = Cliente::where('tipo_cliente', 'persona')->count();

        return view('clientes.index', compact(
            'clientes',
            'totalClientes',
            'totalEmpresas',
            'totalPersonas'
        ));
    }

    /**
     * Muestra el formulario para crear un nuevo cliente.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Valida y guarda un nuevo cliente en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_cliente' => 'required|in:persona,empresa',
            'codigo' => [
                'required',
                'unique:clientes',
                'numeric',
                $request->tipo_cliente === 'persona' ? 'digits:8' : 'digits:11'
            ],
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente registrado correctamente.');
    }

    /**
     * Muestra el detalle de un cliente específico.
     */
    public function show(string $id)
    {
        $clientes = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Muestra el formulario para editar un cliente existente.
     */
    public function edit(string $id)
    {
        $clientes = Cliente::findOrFail($id);
        return view('clientes.edit',compact('cliente'));
    }

    /**
     * Valida y actualiza un cliente en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'tipo_cliente' => 'required|in:persona,empresa',
            'codigo' => [
                'required',
                'numeric',
                'unique:clientes,codigo,' . $id,
                $request->tipo_cliente === 'persona' ? 'digits:8' : 'digits:11'
            ],
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Elimina un cliente en la base de datos.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);

        try {
            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'No se puede eliminar el cliente porque tiene proyectos asociados.');
        }
    }
}
