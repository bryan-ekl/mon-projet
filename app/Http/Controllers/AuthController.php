<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function afficherFormulaireInscription()
    {
        return view("auth.inscription");
    }

    public function inscrire(Request $requete)
    {
        $requete->validate([
            "nom" => "required|string|max:255",
            "nom_entreprise" => "nullable|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "mot_de_passe" => "required|string|min:8|confirmed",
        ]);

        $utilisateur = User::create([
            "nom" => $requete->nom,
            "nom_entreprise" => $requete->nom_entreprise,
            "email" => $requete->email,
            "mot_de_passe" => Hash::make($requete->mot_de_passe),
            "role" => "entrepreneur_en_attente",
        ]);

        Auth::login($utilisateur);

        return redirect("/dashboard")->with("succes", "Votre demande de stand est en attente d'approbation.");
    }

    public function afficherFormulaireConnexion()
    {
        return view("auth.connexion");
    }

    public function connecter(Request $requete)
    {
        $credentials = $requete->validate([
            "email" => "required|email",
            "mot_de_passe" => "required",
        ]);

        if (Auth::attempt(["email" => $credentials["email"], "password" => $credentials["mot_de_passe"]])) {
            $requete->session()->regenerate();

            return redirect()->intended("/dashboard");
        }

        return back()->withErrors([
            "email" => "Les informations d'identification fournies ne correspondent pas à nos enregistrements.",
        ])->onlyInput("email");
    }

    public function deconnecter(Request $requete)
    {
        Auth::logout();

        $requete->session()->invalidate();
        $requete->session()->regenerateToken();

        return redirect("/");
    }
}