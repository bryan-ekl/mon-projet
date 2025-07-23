<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Stand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    public function index()
    {
        $utilisateur = Auth::user();
        $stand = $utilisateur->stands->first(); // Supposons un seul stand par entrepreneur

        if (!$stand) {
            return redirect()->route("dashboard")->with("erreur", "Vous devez d'abord créer un stand.");
        }

        $produits = $stand->produits;
        return view("produits.index", compact("produits", "stand"));
    }

    public function creer()
    {
        $utilisateur = Auth::user();
        $stand = $utilisateur->stands->first();

        if (!$stand) {
            return redirect()->route("dashboard")->with("erreur", "Vous devez d'abord créer un stand.");
        }

        return view("produits.creer", compact("stand"));
    }

    public function enregistrer(Request $requete)
    {
        $requete->validate([
            "nom" => "required|string|max:255",
            "description" => "required|string",
            "prix" => "required|numeric|min:0",
            "image_url" => "nullable|url",
            "stand_id" => "required|exists:stands,id",
        ]);

        $produit = Produit::create($requete->all());

        return redirect()->route("produits.index")->with("succes", "Produit ajouté avec succès.");
    }

    public function modifier(Produit $produit)
    {
        return view("produits.modifier", compact("produit"));
    }

    public function mettreAJour(Request $requete, Produit $produit)
    {
        $requete->validate([
            "nom" => "required|string|max:255",
            "description" => "required|string",
            "prix" => "required|numeric|min:0",
            "image_url" => "nullable|url",
        ]);

        $produit->update($requete->all());

        return redirect()->route("produits.index")->with("succes", "Produit mis à jour avec succès.");
    }

    public function supprimer(Produit $produit)
    {
        $produit->delete();

        return redirect()->route("produits.index")->with("succes", "Produit supprimé avec succès.");
    }
}