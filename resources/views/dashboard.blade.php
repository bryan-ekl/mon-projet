<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Eat&Drink</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-green-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Eat&Drink - Entrepreneur</h1>
            <form method="POST" action="{{ route('deconnexion') }}">
                @csrf
                <button type="submit" class="bg-green-700 hover:bg-green-800 px-4 py-2 rounded">
                    Se déconnecter
                </button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-2xl font-bold mb-6">Bienvenue, {{ Auth::user()->nom }}!</h2>
        
        @if (session('succes'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('succes') }}
            </div>
        @endif

        @if (session('erreur'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('erreur') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Carte Mes Produits -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Mes Produits</h3>
                        <p class="text-gray-600">Gérer vos produits</p>
                    </div>
                </div>
                <a href="{{ route('produits.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded inline-block">
                    Voir mes produits
                </a>
            </div>

            <!-- Carte Statistiques -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Statistiques</h3>
                        <p class="text-gray-600">Voir vos performances</p>
                    </div>
                </div>
                <p class="text-2xl font-bold text-green-600">
                    {{ Auth::user()->stands->first()->produits->count() ?? 0 }} produits
                </p>
            </div>

            <!-- Carte Profil -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Mon Profil</h3>
                        <p class="text-gray-600">Gérer mon compte</p>
                    </div>
                </div>
                <div class="text-sm text-gray-600">
                    <p><strong>Entreprise:</strong> {{ Auth::user()->nom_entreprise ?? 'Non spécifié' }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Section Actions rapides -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold mb-4">Actions rapides</h3>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('produits.creer') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg">
                    Ajouter un produit
                </a>
                <a href="{{ route('exposants.liste') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">
                    Voir tous les exposants
                </a>
            </div>
        </div>
    </div>
</body>
</html>

