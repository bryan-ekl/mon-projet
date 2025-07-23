<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function passerCommande(Request $requete)
    {
        $requete->validate([
            "stand_id" => "required|exists:stands,id",
            "produits" => "required|array",
            "produits.*.id" => "required|exists:produits,id",
            "produits.*.quantite" => "required|integer|min:1",
        ]);

        Commande::create([
            "stand_id" => $requete->stand_id,
            "details_commande" => $requete->produits,
            "date_commande" => now(),
        ]);

        return back()->with("succes", "Votre commande a été passée avec succès!");
    }
}