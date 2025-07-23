<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function tableauDeBord()
    {
        $demandesEnAttente = User::where("role", "entrepreneur_en_attente")->get();
        return view("admin.tableau_de_bord", compact("demandesEnAttente"));
    }

    public function approuverDemande(User $utilisateur)
    {
        $utilisateur->role = "entrepreneur_approuve";
        $utilisateur->save();

        return redirect()->route("admin.tableau_de_bord")->with("succes", "La demande de " . $utilisateur->nom . " a été approuvée.");
    }

    public function rejeterDemande(Request $requete, User $utilisateur)
    {
        // Optionnel: ajouter un motif de rejet
        $utilisateur->delete(); // Ou changer le rôle à 'rejete' et garder une trace

        return redirect()->route("admin.tableau_de_bord")->with("succes", "La demande de " . $utilisateur->nom . " a été rejetée.");
    }
}