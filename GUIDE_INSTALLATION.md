# Guide d'Installation - Projet Eat&Drink Laravel

## Introduction

Ce guide vous explique comment installer et configurer le projet **Eat&Drink**, une application web Laravel pour la gestion d'événements culinaires. L'application permet aux entrepreneurs de créer des stands virtuels, de gérer leurs produits, et aux visiteurs de passer des commandes.

## Prérequis Système

Avant d'installer l'application, assurez-vous que votre système dispose des éléments suivants :

### Logiciels Requis
- **PHP 8.1 ou supérieur** avec les extensions suivantes :
  - php-xml
  - php-curl
  - php-sqlite3 (pour la base de données SQLite)
  - php-mbstring
  - php-openssl
- **Composer** (gestionnaire de dépendances PHP)
- **Node.js et npm** (pour la compilation des assets frontend)
- **Serveur web** (Apache, Nginx, ou serveur intégré PHP)

### Vérification des Prérequis

```bash
# Vérifier la version de PHP
php --version

# Vérifier que Composer est installé
composer --version

# Vérifier que Node.js est installé
node --version
npm --version
```

## Structure du Projet

Voici la structure complète du projet Laravel Eat&Drink :

```
eat-drink/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── AuthController.php
│   │   │   ├── CommandeController.php
│   │   │   ├── ProduitController.php
│   │   │   └── PublicController.php
│   │   ├── Middleware/
│   │   │   └── RoleMiddleware.php
│   │   └── Kernel.php
│   └── Models/
│       ├── User.php
│       ├── Stand.php
│       ├── Produit.php
│       └── Commande.php
├── database/
│   ├── migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── create_stands_table.php
│   │   ├── create_produits_table.php
│   │   └── create_commandes_table.php
│   ├── seeders/
│   │   └── DatabaseSeeder.php
│   └── database.sqlite
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── inscription.blade.php
│       │   └── connexion.blade.php
│       ├── admin/
│       │   └── tableau_de_bord.blade.php
│       ├── produits/
│       │   ├── index.blade.php
│       │   ├── creer.blade.php
│       │   └── modifier.blade.php
│       ├── public/
│       │   ├── exposants.blade.php
│       │   └── stand.blade.php
│       ├── dashboard.blade.php
│       ├── attente_approbation.blade.php
│       └── welcome.blade.php
├── routes/
│   └── web.php
├── .env
└── composer.json
```



## Installation Étape par Étape

### Étape 1 : Téléchargement et Extraction

1. Téléchargez le fichier ZIP du projet
2. Extrayez le contenu dans le répertoire de votre choix (par exemple : `/var/www/html/eat-drink`)

```bash
# Exemple d'extraction
unzip eat-drink-project.zip
cd eat-drink
```

### Étape 2 : Installation des Dépendances PHP

Installez les dépendances PHP avec Composer :

```bash
composer install
```

Cette commande va télécharger et installer toutes les bibliothèques PHP nécessaires listées dans le fichier `composer.json`.

### Étape 3 : Configuration de l'Environnement

1. Copiez le fichier d'environnement :
```bash
cp .env.example .env
```

2. Le fichier `.env` est déjà configuré pour utiliser SQLite. Voici la configuration par défaut :

```env
APP_NAME=EatDrink
APP_ENV=local
APP_KEY=base64:VOTRE_CLE_GENEREE
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=/chemin/absolu/vers/database/database.sqlite
```

3. Générez la clé d'application :
```bash
php artisan key:generate
```

### Étape 4 : Configuration de la Base de Données

1. Créez le fichier de base de données SQLite :
```bash
touch database/database.sqlite
```

2. Exécutez les migrations pour créer les tables :
```bash
php artisan migrate
```

3. Peuplez la base de données avec des données de test :
```bash
php artisan db:seed
```

Cette commande créera :
- Un administrateur : `admin@eatdrink.com` / `password123`
- Deux entrepreneurs avec leurs stands et produits
- Un entrepreneur en attente d'approbation

### Étape 5 : Installation des Dépendances Frontend (Optionnel)

Si vous souhaitez modifier les styles ou scripts :

```bash
npm install
npm run dev
```

### Étape 6 : Lancement du Serveur

Démarrez le serveur de développement Laravel :

```bash
php artisan serve
```

L'application sera accessible à l'adresse : `http://localhost:8000`

## Configuration de Production

Pour un déploiement en production, suivez ces étapes supplémentaires :

### 1. Configuration Apache/Nginx

**Apache (.htaccess) :**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

**Nginx :**
```nginx
server {
    listen 80;
    server_name votre-domaine.com;
    root /chemin/vers/eat-drink/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 2. Optimisation pour la Production

```bash
# Optimiser l'autoloader
composer install --optimize-autoloader --no-dev

# Mettre en cache la configuration
php artisan config:cache

# Mettre en cache les routes
php artisan route:cache

# Mettre en cache les vues
php artisan view:cache
```

### 3. Permissions des Fichiers

```bash
# Donner les bonnes permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```


## Explication Détaillée des Fichiers

### Fichiers de Configuration

#### `.env`
**Emplacement :** Racine du projet  
**Rôle :** Contient toutes les variables d'environnement (base de données, clés API, configuration de l'application)

#### `composer.json`
**Emplacement :** Racine du projet  
**Rôle :** Définit les dépendances PHP et les scripts Composer

### Modèles (app/Models/)

#### `User.php`
**Rôle :** Modèle pour les utilisateurs (entrepreneurs, administrateurs, participants)  
**Fonctionnalités :**
- Gestion de l'authentification
- Relations avec les stands
- Rôles utilisateur (admin, entrepreneur_approuve, entrepreneur_en_attente, participant)

#### `Stand.php`
**Rôle :** Modèle pour les stands d'exposition  
**Fonctionnalités :**
- Appartient à un utilisateur (entrepreneur)
- Contient plusieurs produits
- Stocke les informations du stand (nom, description)

#### `Produit.php`
**Rôle :** Modèle pour les produits vendus sur les stands  
**Fonctionnalités :**
- Appartient à un stand
- Contient les informations produit (nom, description, prix, image)

#### `Commande.php`
**Rôle :** Modèle pour les commandes passées par les visiteurs  
**Fonctionnalités :**
- Stocke les détails de commande
- Lien avec les produits commandés

### Contrôleurs (app/Http/Controllers/)

#### `AuthController.php`
**Rôle :** Gestion de l'authentification  
**Méthodes principales :**
- `afficherFormulaireInscription()` : Affiche le formulaire d'inscription
- `inscrire()` : Traite l'inscription d'un nouvel utilisateur
- `afficherFormulaireConnexion()` : Affiche le formulaire de connexion
- `connecter()` : Traite la connexion
- `deconnecter()` : Déconnecte l'utilisateur

#### `AdminController.php`
**Rôle :** Gestion des fonctionnalités administrateur  
**Méthodes principales :**
- `tableauDeBord()` : Affiche le tableau de bord admin
- `approuverDemande()` : Approuve une demande de stand
- `rejeterDemande()` : Rejette une demande de stand

#### `ProduitController.php`
**Rôle :** Gestion CRUD des produits par les entrepreneurs  
**Méthodes principales :**
- `index()` : Liste les produits de l'entrepreneur
- `creer()` : Affiche le formulaire de création
- `enregistrer()` : Enregistre un nouveau produit
- `modifier()` : Affiche le formulaire de modification
- `mettreAJour()` : Met à jour un produit
- `supprimer()` : Supprime un produit

#### `PublicController.php`
**Rôle :** Gestion des pages publiques  
**Méthodes principales :**
- `listeExposants()` : Affiche la liste des stands approuvés
- `afficherStand()` : Affiche le détail d'un stand avec ses produits

#### `CommandeController.php`
**Rôle :** Gestion des commandes  
**Méthodes principales :**
- `passerCommande()` : Traite une nouvelle commande

### Middleware (app/Http/Middleware/)

#### `RoleMiddleware.php`
**Rôle :** Contrôle d'accès basé sur les rôles  
**Fonctionnalité :** Vérifie que l'utilisateur a le bon rôle pour accéder à une route

### Migrations (database/migrations/)

#### `create_users_table.php`
**Rôle :** Crée la table des utilisateurs  
**Champs :**
- `nom` : Nom de l'utilisateur
- `nom_entreprise` : Nom de l'entreprise (nullable)
- `email` : Adresse email (unique)
- `password` : Mot de passe hashé
- `role` : Rôle de l'utilisateur

#### `create_stands_table.php`
**Rôle :** Crée la table des stands  
**Champs :**
- `nom_stand` : Nom du stand
- `description` : Description du stand
- `utilisateur_id` : Référence vers l'utilisateur propriétaire

#### `create_produits_table.php`
**Rôle :** Crée la table des produits  
**Champs :**
- `nom` : Nom du produit
- `description` : Description du produit
- `prix` : Prix du produit (decimal)
- `image_url` : URL de l'image (nullable)
- `stand_id` : Référence vers le stand

#### `create_commandes_table.php`
**Rôle :** Crée la table des commandes  
**Champs :**
- `stand_id` : Référence vers le stand
- `details_produits` : Détails des produits commandés (JSON)
- `total` : Montant total de la commande


### Vues (resources/views/)

#### Vues d'Authentification (auth/)

**`inscription.blade.php`**  
**Rôle :** Formulaire d'inscription pour les nouveaux utilisateurs  
**Fonctionnalités :**
- Champs : nom, nom d'entreprise, email, mot de passe
- Validation côté client
- Design responsive avec Tailwind CSS

**`connexion.blade.php`**  
**Rôle :** Formulaire de connexion  
**Fonctionnalités :**
- Champs : email, mot de passe
- Gestion des erreurs de connexion
- Lien vers l'inscription

#### Vues Administrateur (admin/)

**`tableau_de_bord.blade.php`**  
**Rôle :** Interface d'administration  
**Fonctionnalités :**
- Liste des demandes de stand en attente
- Boutons d'approbation/rejet
- Statistiques générales

#### Vues Entrepreneur (produits/)

**`index.blade.php`**  
**Rôle :** Liste des produits de l'entrepreneur  
**Fonctionnalités :**
- Affichage en grille des produits
- Boutons de modification/suppression
- Lien vers l'ajout de produit

**`creer.blade.php`**  
**Rôle :** Formulaire de création de produit  
**Fonctionnalités :**
- Champs : nom, description, prix, URL image
- Validation des données
- Prévisualisation optionnelle

**`modifier.blade.php`**  
**Rôle :** Formulaire de modification de produit  
**Fonctionnalités :**
- Pré-remplissage des champs existants
- Mise à jour des informations
- Confirmation avant sauvegarde

#### Vues Publiques (public/)

**`exposants.blade.php`**  
**Rôle :** Liste publique des stands approuvés  
**Fonctionnalités :**
- Affichage des stands avec leurs informations
- Liens vers le détail de chaque stand
- Design attractif pour les visiteurs

**`stand.blade.php`**  
**Rôle :** Page détail d'un stand avec panier  
**Fonctionnalités :**
- Affichage des produits du stand
- Système de panier interactif (JavaScript)
- Calcul automatique du total
- Formulaire de commande

#### Autres Vues

**`welcome.blade.php`**  
**Rôle :** Page d'accueil du site  
**Fonctionnalités :**
- Présentation de l'événement
- Navigation vers les différentes sections
- Design moderne et attractif

**`dashboard.blade.php`**  
**Rôle :** Tableau de bord entrepreneur  
**Fonctionnalités :**
- Statistiques personnelles
- Raccourcis vers les fonctionnalités principales
- Gestion du profil

**`attente_approbation.blade.php`**  
**Rôle :** Page d'attente pour les entrepreneurs non approuvés  
**Fonctionnalités :**
- Message d'information
- Instructions pour l'utilisateur

### Routes (routes/web.php)

#### Routes Publiques
```php
Route::get('/', function () {
    return view('welcome');
});
Route::get("/exposants", [PublicController::class, "listeExposants"]);
Route::get("/exposants/{stand}", [PublicController::class, "afficherStand"]);
Route::post("/commandes", [CommandeController::class, "passerCommande"]);
```

#### Routes d'Authentification
```php
Route::get("/inscription", [AuthController::class, "afficherFormulaireInscription"]);
Route::post("/inscription", [AuthController::class, "inscrire"]);
Route::get("/connexion", [AuthController::class, "afficherFormulaireConnexion"]);
Route::post("/connexion", [AuthController::class, "connecter"]);
Route::post("/deconnexion", [AuthController::class, "deconnecter"]);
```

#### Routes Administrateur (Protégées)
```php
Route::middleware(["auth", "role:admin"])->prefix("admin")->group(function () {
    Route::get("/tableau-de-bord", [AdminController::class, "tableauDeBord"]);
    Route::post("/demandes/{utilisateur}/approuver", [AdminController::class, "approuverDemande"]);
    Route::post("/demandes/{utilisateur}/rejeter", [AdminController::class, "rejeterDemande"]);
});
```

#### Routes Entrepreneur (Protégées)
```php
Route::middleware(["auth", "role:entrepreneur_approuve"])->prefix("produits")->group(function () {
    Route::get("/", [ProduitController::class, "index"]);
    Route::get("/creer", [ProduitController::class, "creer"]);
    Route::post("/", [ProduitController::class, "enregistrer"]);
    Route::get("/{produit}/modifier", [ProduitController::class, "modifier"]);
    Route::put("/{produit}", [ProduitController::class, "mettreAJour"]);
    Route::delete("/{produit}", [ProduitController::class, "supprimer"]);
});
```


## Comptes de Test Disponibles

Après avoir exécuté `php artisan db:seed`, vous disposerez des comptes suivants :

### Administrateur
- **Email :** `admin@eatdrink.com`
- **Mot de passe :** `password123`
- **Rôle :** Administrateur
- **Accès :** Tableau de bord admin, gestion des demandes

### Entrepreneurs Approuvés

#### Jean Dupont (Boulangerie)
- **Email :** `jean@boulangerie.com`
- **Mot de passe :** `password123`
- **Entreprise :** Boulangerie Dupont
- **Stand :** Boulangerie Artisanale Dupont
- **Produits :** Pain de campagne, Croissant au beurre, Tarte aux pommes

#### Pierre Dubois (Charcuterie)
- **Email :** `pierre@charcuterie.com`
- **Mot de passe :** `password123`
- **Entreprise :** Charcuterie Dubois
- **Stand :** Charcuterie Traditionnelle Dubois
- **Produits :** Saucisson sec, Pâté de campagne

### Entrepreneur en Attente
- **Email :** `marie@fromagerie.com`
- **Mot de passe :** `password123`
- **Entreprise :** Fromagerie Martin
- **Statut :** En attente d'approbation

## Fonctionnalités de l'Application

### Pour les Visiteurs (Non connectés)
- Consulter la page d'accueil
- Voir la liste des exposants approuvés
- Visiter les stands individuels
- Passer des commandes (simulation)

### Pour les Entrepreneurs
- S'inscrire et créer un profil
- Attendre l'approbation de l'administrateur
- Gérer leurs produits (CRUD complet)
- Consulter leur tableau de bord

### Pour les Administrateurs
- Approuver ou rejeter les demandes de stand
- Consulter les statistiques générales
- Gérer les utilisateurs

## Personnalisation et Développement

### Modification des Styles
Les vues utilisent **Tailwind CSS** via CDN. Pour personnaliser les styles :

1. Modifiez directement les classes dans les fichiers `.blade.php`
2. Ou créez un fichier CSS personnalisé dans `public/css/`

### Ajout de Nouvelles Fonctionnalités

#### Créer un Nouveau Contrôleur
```bash
php artisan make:controller NomController
```

#### Créer un Nouveau Modèle avec Migration
```bash
php artisan make:model NomModele -m
```

#### Créer une Nouvelle Vue
Créez un fichier `.blade.php` dans `resources/views/`

### Base de Données

#### Ajouter une Nouvelle Migration
```bash
php artisan make:migration nom_de_la_migration
php artisan migrate
```

#### Réinitialiser la Base de Données
```bash
php artisan migrate:fresh --seed
```

## Dépannage

### Problèmes Courants

#### Erreur "Class not found"
```bash
composer dump-autoload
```

#### Erreur de Permissions
```bash
chmod -R 755 storage bootstrap/cache
```

#### Erreur de Base de Données
1. Vérifiez que le fichier `database/database.sqlite` existe
2. Vérifiez les permissions du fichier
3. Relancez les migrations : `php artisan migrate:fresh --seed`

#### Page Blanche ou Erreur 500
1. Vérifiez les logs dans `storage/logs/laravel.log`
2. Activez le debug dans `.env` : `APP_DEBUG=true`
3. Vérifiez que la clé d'application est générée : `php artisan key:generate`

#### Problèmes de Routes
1. Videz le cache des routes : `php artisan route:clear`
2. Vérifiez la syntaxe dans `routes/web.php`

### Logs et Débogage

#### Consulter les Logs
```bash
tail -f storage/logs/laravel.log
```

#### Activer le Mode Debug
Dans le fichier `.env` :
```env
APP_DEBUG=true
APP_LOG_LEVEL=debug
```

## Sécurité

### Recommandations pour la Production

1. **Désactiver le Debug :**
```env
APP_DEBUG=false
```

2. **Utiliser HTTPS :**
```env
APP_URL=https://votre-domaine.com
```

3. **Sécuriser les Fichiers Sensibles :**
- Placez le fichier `.env` hors du répertoire web
- Configurez les permissions appropriées

4. **Mettre à Jour Régulièrement :**
```bash
composer update
```

## Support et Maintenance

### Sauvegarde
- Sauvegardez régulièrement le fichier `database/database.sqlite`
- Sauvegardez le fichier `.env`
- Sauvegardez les fichiers uploadés (si applicable)

### Mise à Jour
Pour mettre à jour Laravel ou les dépendances :
```bash
composer update
php artisan migrate
```

## Conclusion

Ce guide couvre l'installation complète et la configuration du projet Eat&Drink. L'application est conçue pour être simple à comprendre et à maintenir, avec un code commenté en français et des variables explicites.

Pour toute question ou problème, consultez d'abord les logs de l'application et vérifiez que tous les prérequis sont installés correctement.

