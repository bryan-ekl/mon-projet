<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le produit - Eat&Drink</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-green-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Eat&Drink - Entrepreneur</h1>
            <div class="flex space-x-4">
                <a href="{{ route('produits.index') }}" class="bg-green-700 hover:bg-green-800 px-4 py-2 rounded">
                    Mes produits
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
        <div class="max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold mb-6">Modifier le produit</h2>
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $erreur)
                            <li>{{ $erreur }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-6 rounded-lg shadow-md">
                <form method="POST" action="{{ route('produits.mettre_a_jour', $produit) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom du produit</label>
                        <input type="text" id="nom" name="nom" value="{{ old('nom', $produit->nom) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea id="description" name="description" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>{{ old('description', $produit->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="prix" class="block text-gray-700 text-sm font-bold mb-2">Prix (€)</label>
                        <input type="number" id="prix" name="prix" value="{{ old('prix', $produit->prix) }}" step="0.01" min="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label for="image_url" class="block text-gray-700 text-sm font-bold mb-2">URL de l'image (optionnel)</label>
                        <input type="url" id="image_url" name="image_url" value="{{ old('image_url', $produit->image_url) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                               placeholder="https://exemple.com/image.jpg">
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                            Mettre à jour
                        </button>
                        <a href="{{ route('produits.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

