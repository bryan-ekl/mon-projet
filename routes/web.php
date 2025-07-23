<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CommandeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification
Route::get("/inscription", [AuthController::class, "afficherFormulaireInscription"])->name("inscription");
Route::post("/inscription", [AuthController::class, "inscrire"]);
Route::get("/connexion", [AuthController::class, "afficherFormulaireConnexion"])->name("connexion");
Route::post("/connexion", [AuthController::class, "connecter"]);
Route::post("/deconnexion", [AuthController::class, "deconnecter"])->name("deconnexion");

// Redirection du dashboard en fonction du rôle
Route::get("/dashboard", function () {
    if (Auth::user()->role === "admin") {
        return redirect()->route("admin.tableau_de_bord");
    } elseif (Auth::user()->role === "entrepreneur_approuve") {
        return view("dashboard"); // Tableau de bord de l'entrepreneur
    } elseif (Auth::user()->role === "entrepreneur_en_attente") {
        return view("attente_approbation");
    }
    return view("dashboard"); // Pour les participants ou autres rôles
})->middleware(["auth"])->name("dashboard");

// Routes Administrateur
Route::middleware(["auth", "role:admin"])->prefix("admin")->name("admin.")->group(function () {
    Route::get("/tableau-de-bord", [AdminController::class, "tableauDeBord"])->name("tableau_de_bord");
    Route::post("/demandes/{utilisateur}/approuver", [AdminController::class, "approuverDemande"])->name("approuver_demande");
    Route::post("/demandes/{utilisateur}/rejeter", [AdminController::class, "rejeterDemande"])->name("rejeter_demande");
});

// Routes Entrepreneur (Gestion des Produits)
Route::middleware(["auth", "role:entrepreneur_approuve"])->prefix("produits")->name("produits.")->group(function () {
    Route::get("/", [ProduitController::class, "index"])->name("index");
    Route::get("/creer", [ProduitController::class, "creer"])->name("creer");
    Route::post("/", [ProduitController::class, "enregistrer"])->name("enregistrer");
    Route::get("/{produit}/modifier", [ProduitController::class, "modifier"])->name("modifier");
    Route::put("/{produit}", [ProduitController::class, "mettreAJour"])->name("mettre_a_jour");
    Route::delete("/{produit}", [ProduitController::class, "supprimer"])->name("supprimer");
});

// Routes Publiques (Vitrine et Commandes)
Route::get("/exposants", [PublicController::class, "listeExposants"])->name("exposants.liste");
Route::get("/exposants/{stand}", [PublicController::class, "afficherStand"])->name("exposants.afficher");
Route::post("/commandes", [CommandeController::class, "passerCommande"])->name("commandes.passer");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
