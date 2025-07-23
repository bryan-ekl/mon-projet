<?php

namespace App\Http\Controllers;

use App\Models\Stand;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function listeExposants()
    {
        $stands = Stand::whereHas("utilisateur", function ($query) {
            $query->where("role", "entrepreneur_approuve");
        })->get();
        return view("public.exposants", compact("stands"));
    }

    public function afficherStand(Stand $stand)
    {
        $produits = $stand->produits;
        return view("public.stand", compact("stand", "produits"));
    }
}