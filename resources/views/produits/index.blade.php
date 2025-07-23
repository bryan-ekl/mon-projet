<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Produits - Eat&Drink</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-green-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Eat&Drink - Entrepreneur</h1>
            <div class="flex space-x-4">
                <a href="{{ route('dashboard') }}" class="bg-green-700 hover:bg-green-800 px-4 py-2 rounded">
                    Tableau de bord
                </a>
                <form method="POST" action="{{ route('deconnexion') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-green-700 hover:bg-green-800 px-4 py-2 rounded">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Mes Produits</h2>
            <a href="{{ route('produits.creer') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Ajouter un produit
            </a>
        </div>
        
        @if (session('succes'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('succes') }}
            </div>
        @endif

        @if ($produits->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($produits as $produit)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if ($produit->image_url)
                            <img src="{{ $produit->image_url }}" alt="{{ $produit->nom }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">Aucune image</span>
                            </div>
                        @endif
                        
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">{{ $produit->nom }}</h3>
                            <p class="text-gray-600 mb-2">{{ Str::limit($produit->description, 100) }}</p>
                            <p class="text-xl font-bold text-green-600 mb-4">{{ number_format($produit->prix, 2) }} €</p>
                            
                            <div class="flex space-x-2">
                                <a href="{{ route('produits.modifier', $produit) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                    Modifier
                                </a>
                                <form method="POST" action="{{ route('produits.supprimer', $produit) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <p class="text-gray-500 mb-4">Vous n'avez encore ajouté aucun produit.</p>
                <a href="{{ route('produits.creer') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Ajouter votre premier produit
                </a>
            </div>
        @endif
    </div>
</body>
</html>

