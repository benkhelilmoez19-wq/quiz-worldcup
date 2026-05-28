<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion.
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Gère la tentative de connexion.
     */
    public function login(Request $request)
    {
        // Validation des données saisies
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tentative d'authentification
        if (Auth::attempt($credentials)) {
            // Régénérer la session pour éviter les attaques de fixation de session
            $request->session()->regenerate();

            // RÉDIRECTION DYNAMIQUE SELON LE RÔLE
            // On vérifie la colonne 'role' de l'utilisateur qui vient de se connecter
            if (Auth::user()->role === 'admin') {
                // Redirige vers la route nommée 'admin.dashboard' (votre vue admin/dashboard.blade.php)
                return redirect()->route('admin.dashboard');
            }

            // Redirige vers le dashboard par défaut pour les joueurs
            return redirect()->intended('dashboard');
        }

        // Si la connexion échoue, retour au formulaire avec une erreur
        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalider la session actuelle
        $request->session()->invalidate();

        // Régénérer le jeton CSRF
        $request->session()->regenerateToken();

        return redirect('/');
    }
}