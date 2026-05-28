<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Affiche le formulaire d'inscription
     */
    public function show() 
    {
        return view('auth.register');
    }

    /**
     * Traite l'inscription (Renommé en 'register' pour corriger l'erreur)
     */
    public function register(Request $request) 
    {
        // 1. Validation des données
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nationality' => ['required', 'string'],
        ]);

        // 2. Création de l'utilisateur avec les champs de votre table SQL
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'player', // Rôle par défaut selon votre structure
            'nationality' => $request->nationality,
            'address' => $request->address ?? null, // Optionnel
        ]);

        // 3. Connexion automatique
        Auth::login($user);

        // 4. Redirection vers le dashboard
        return redirect()->route('dashboard');
    }
}