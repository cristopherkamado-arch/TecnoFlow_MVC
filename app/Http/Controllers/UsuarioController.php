<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Muestra la lista de todos los usuarios.
     */
    public function index()
    {
        $usuarios      = User::orderBy('name')->get();
        $totalUsuarios = User::count();
        $totalAdmins   = User::where('role', 'admin')->count();
        $totalEmpleados = User::where('role', 'employee')->count();

        return view('usuarios.index', compact(
            'usuarios',
            'totalUsuarios',
            'totalAdmins',
            'totalEmpleados'
        ));
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Valida y guarda un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,employee',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy(string $id)
    {
        $usuario = User::findOrFail($id);

        // No puede eliminarse a sí mismo
        if ($usuario->id === Auth::id()) {
            return redirect()->route('usuarios.index')->with('error', 'No puedes eliminarte a ti mismo.');
        }

        // No puede eliminar a otros admins
        if ($usuario->role === 'admin') {
            return redirect()->route('usuarios.index')->with('error', 'No puedes eliminar a otro administrador.');
        }

        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}