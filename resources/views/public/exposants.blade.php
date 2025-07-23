<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Exposants - Eat&Drink</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-orange-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Eat&Drink</h1>
            <div class="flex space-x-4">
                <a href="/" class="hover:text-orange-200">Accueil</a>
                <a href="{{ route('exposants.liste') }}" class="hover:text-orange-200">Exposants</a>
                <a href="{{ route('connexion') }}" class="hover:text-orange-200">Connexion</a>
                <a href="{{ route('inscription') }}" class="hover:text-orange-200">Inscription</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Nos Exposants</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Découvrez tous nos exposants approuvés et leurs délicieux produits. 
                Cliquez sur un stand pour voir tous ses produits et passer commande.
            </p>
        </div>

        @if ($stands->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($stands as $stand)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $stand->nom_stand }}</h3>
                            <p class="text-gray-600 mb-3">{{ Str::limit($stand->description, 120) }}</p>
                            
                            <div class="flex items-center justify-between mb-4">
                                <div class="text-sm text-gray-500">
                                    <p><strong>Entrepreneur:</strong> {{ $stand->utilisateur->nom }}</p>
                                    @if ($stand->utilisateur->nom_entreprise)
                                        <p><strong>Entreprise:</strong> {{ $stand->utilisateur->nom_entreprise }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    {{ $stand->produits->count() }} produit(s)
                                </span>
                                <a href="{{ route('exposants.afficher', $stand) }}" 
                                   class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">
                                    Voir le stand
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Aucun exposant pour le moment</h3>
                <p class="text-gray-600">Les exposants approuvés apparaîtront ici bientôt.</p>
            </div>
        @endif
    </div>

    <footer class="bg-gray-800 text-white mt-16 py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 Eat&Drink. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>

