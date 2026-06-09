<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Valida las credenciales y autentica al usuario.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', '¡Bienvenido, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    /**
     * Cierra la sesión del usuario autenticado.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }

    /**
     * Muestra el formulario para solicitar recuperación de contraseña.
     */
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Verifica si el email existe en la base de datos.
     */
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Email verificado correctamente'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'El correo electrónico no está registrado en el sistema'
        ], 404);
    }

    /**
     * Actualiza la contraseña del usuario directamente.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('success', 'Contraseña actualizada correctamente. Por favor, inicia sesión con tu nueva contraseña.');
        }

        return back()->withErrors(['email' => 'No se encontró el usuario.']);
    }
}
