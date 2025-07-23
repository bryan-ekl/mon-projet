<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Stand;
use App\Models\Produit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un utilisateur administrateur
        $admin = User::create([
            'nom' => 'Administrateur',
            'nom_entreprise' => null,
            'email' => 'admin@eatdrink.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Créer un entrepreneur approuvé avec un stand
        $entrepreneur = User::create([
            'nom' => 'Jean Dupont',
            'nom_entreprise' => 'Boulangerie Dupont',
            'email' => 'jean@boulangerie.com',
            'password' => Hash::make('password123'),
            'role' => 'entrepreneur_approuve',
        ]);

        $stand = Stand::create([
            'nom_stand' => 'Boulangerie Artisanale Dupont',
            'description' => 'Spécialiste du pain artisanal et des viennoiseries depuis 1985. Nous utilisons uniquement des ingrédients de qualité pour vous offrir le meilleur du savoir-faire français.',
            'utilisateur_id' => $entrepreneur->id,
        ]);

        // Créer des produits pour ce stand
        Produit::create([
            'nom' => 'Pain de campagne',
            'description' => 'Pain traditionnel au levain, cuit au feu de bois. Croûte dorée et mie alvéolée.',
            'prix' => 3.50,
            'image_url' => 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?w=400',
            'stand_id' => $stand->id,
        ]);

        Produit::create([
            'nom' => 'Croissant au beurre',
            'description' => 'Viennoiserie feuilletée au beurre AOP, croustillante et fondante.',
            'prix' => 1.20,
            'image_url' => 'https://images.unsplash.com/photo-1555507036-ab794f4ec5d5?w=400',
            'stand_id' => $stand->id,
        ]);

        Produit::create([
            'nom' => 'Tarte aux pommes',
            'description' => 'Tarte maison aux pommes Golden, pâte brisée et compote de pommes.',
            'prix' => 18.00,
            'image_url' => 'https://images.unsplash.com/photo-1621743478914-cc8a86d7e7b5?w=400',
            'stand_id' => $stand->id,
        ]);

        // Créer un entrepreneur en attente
        User::create([
            'nom' => 'Marie Martin',
            'nom_entreprise' => 'Fromagerie Martin',
            'email' => 'marie@fromagerie.com',
            'password' => Hash::make('password123'),
            'role' => 'entrepreneur_en_attente',
        ]);

        // Créer un deuxième entrepreneur approuvé
        $entrepreneur2 = User::create([
            'nom' => 'Pierre Dubois',
            'nom_entreprise' => 'Charcuterie Dubois',
            'email' => 'pierre@charcuterie.com',
            'password' => Hash::make('password123'),
            'role' => 'entrepreneur_approuve',
        ]);

        $stand2 = Stand::create([
            'nom_stand' => 'Charcuterie Traditionnelle Dubois',
            'description' => 'Charcuterie artisanale et produits du terroir. Saucissons, pâtés et rillettes faits maison.',
            'utilisateur_id' => $entrepreneur2->id,
        ]);

        Produit::create([
            'nom' => 'Saucisson sec',
            'description' => 'Saucisson artisanal séché pendant 6 semaines, aux herbes de Provence.',
            'prix' => 12.50,
            'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=400',
            'stand_id' => $stand2->id,
        ]);

        Produit::create([
            'nom' => 'Pâté de campagne',
            'description' => 'Pâté traditionnel aux épices, préparé selon la recette familiale.',
            'prix' => 8.90,
            'image_url' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=400',
            'stand_id' => $stand2->id,
        ]);
    }
}
