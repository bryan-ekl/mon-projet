# Eat&Drink - Plateforme d'Événement Culinaire

## Description

**Eat&Drink** est une application web Laravel qui permet de gérer des événements culinaires en ligne. Elle offre une plateforme où les entrepreneurs peuvent créer des stands virtuels, présenter leurs produits, et où les visiteurs peuvent découvrir et commander auprès de différents exposants.

## Fonctionnalités Principales

### 🏪 Gestion des Stands
- Inscription des entrepreneurs
- Système d'approbation par l'administrateur
- Création et gestion de stands virtuels

### 🍕 Gestion des Produits
- Interface CRUD complète pour les produits
- Upload d'images via URL
- Gestion des prix et descriptions

### 👥 Système d'Utilisateurs
- Authentification sécurisée
- Rôles multiples (Admin, Entrepreneur, Visiteur)
- Tableaux de bord personnalisés

### 🛒 Système de Commandes
- Panier interactif avec JavaScript
- Calcul automatique des totaux
- Interface de commande simplifiée

## Technologies Utilisées

- **Backend :** Laravel 10.x, PHP 8.1+
- **Base de données :** SQLite (facilement configurable pour MySQL/PostgreSQL)
- **Frontend :** Blade Templates, Tailwind CSS, JavaScript Vanilla
- **Authentification :** Laravel Breeze (simplifié)

## Installation Rapide

```bash
# 1. Cloner/extraire le projet
cd eat-drink

# 2. Installer les dépendances
composer install

# 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Créer la base de données
touch database/database.sqlite
php artisan migrate --seed

# 5. Lancer le serveur
php artisan serve
```

## Comptes de Test

Après l'installation, vous pouvez utiliser ces comptes :

- **Admin :** `admin@eatdrink.com` / `password123`
- **Entrepreneur :** `jean@boulangerie.com` / `password123`
- **Entrepreneur :** `pierre@charcuterie.com` / `password123`

## Structure du Code

Le projet suit les conventions Laravel avec des noms de variables en français pour faciliter la compréhension :

```
app/
├── Http/Controllers/     # Contrôleurs avec logique métier
├── Models/              # Modèles Eloquent
└── Http/Middleware/     # Middleware personnalisés

resources/views/         # Templates Blade
├── auth/               # Vues d'authentification
├── admin/              # Interface administrateur
├── produits/           # Gestion des produits
└── public/             # Pages publiques

database/
├── migrations/         # Migrations de base de données
└── seeders/           # Données de test
```

## Documentation Complète

Pour une installation détaillée et la documentation complète, consultez le fichier `GUIDE_INSTALLATION.md`.

## Captures d'Écran

### Page d'Accueil
Interface moderne et responsive présentant l'événement culinaire.

### Liste des Exposants
Découverte des stands approuvés avec leurs informations.

### Interface Entrepreneur
Gestion complète des produits avec interface intuitive.

### Tableau de Bord Admin
Approbation des demandes et gestion des utilisateurs.

## Développement

### Code Style
- Variables et méthodes en français pour la clarité
- Code commenté et documenté
- Structure simple adaptée aux débutants

### Extensibilité
- Architecture modulaire Laravel
- Facilement extensible avec de nouvelles fonctionnalités
- Base de données flexible

## Licence

Ce projet est développé à des fins éducatives et peut être librement modifié et distribué.

## Support

Consultez le `GUIDE_INSTALLATION.md` pour :
- Instructions détaillées d'installation
- Explication de chaque fichier
- Dépannage et maintenance
- Personnalisation et développement

---

**Développé avec ❤️ en Laravel - Code simple et compréhensible pour tous les niveaux**

