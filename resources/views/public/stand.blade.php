<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $stand->nom_stand }} - Eat&Drink</title>
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
        <!-- En-tête du stand -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-3xl font-bold text-gray-800">{{ $stand->nom_stand }}</h2>
                <a href="{{ route('exposants.liste') }}" class="text-orange-600 hover:text-orange-800">
                    ← Retour aux exposants
                </a>
            </div>
            
            <p class="text-gray-600 mb-4">{{ $stand->description }}</p>
            
            <div class="flex items-center text-sm text-gray-500">
                <div class="mr-6">
                    <strong>Entrepreneur:</strong> {{ $stand->utilisateur->nom }}
                </div>
                @if ($stand->utilisateur->nom_entreprise)
                    <div>
                        <strong>Entreprise:</strong> {{ $stand->utilisateur->nom_entreprise }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Messages de succès -->
        @if (session('succes'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('succes') }}
            </div>
        @endif

        <!-- Produits du stand -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold mb-6">Produits disponibles</h3>
            
            @if ($produits->count() > 0)
                <form method="POST" action="{{ route('commandes.passer') }}" id="formulaire-commande">
                    @csrf
                    <input type="hidden" name="stand_id" value="{{ $stand->id }}">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
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
                                    <h4 class="text-lg font-semibold mb-2">{{ $produit->nom }}</h4>
                                    <p class="text-gray-600 mb-3">{{ $produit->description }}</p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xl font-bold text-green-600">{{ number_format($produit->prix, 2) }} €</span>
                                        <div class="flex items-center">
                                            <label for="quantite_{{ $produit->id }}" class="text-sm text-gray-600 mr-2">Qté:</label>
                                            <input type="number" 
                                                   id="quantite_{{ $produit->id }}" 
                                                   name="produits[{{ $loop->index }}][quantite]" 
                                                   min="0" 
                                                   max="10" 
                                                   value="0" 
                                                   class="w-16 px-2 py-1 border border-gray-300 rounded text-center">
                                            <input type="hidden" name="produits[{{ $loop->index }}][id]" value="{{ $produit->id }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Panier et commande -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h4 class="text-lg font-semibold mb-4">Passer commande</h4>
                        <div id="resume-panier" class="mb-4 text-gray-600">
                            Sélectionnez des produits pour voir le résumé de votre commande.
                        </div>
                        <button type="submit" 
                                id="bouton-commander" 
                                class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded disabled:bg-gray-400 disabled:cursor-not-allowed" 
                                disabled>
                            Passer la commande
                        </button>
                    </div>
                </form>
            @else
                <div class="bg-white p-8 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-800 mb-2">Aucun produit disponible</h4>
                    <p class="text-gray-600">Ce stand n'a pas encore ajouté de produits.</p>
                </div>
            @endif
        </div>
    </div>

    <footer class="bg-gray-800 text-white mt-16 py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 Eat&Drink. Tous droits réservés.</p>
        </div>
    </footer>

    <script>
        // Script pour gérer le panier et le résumé de commande
        document.addEventListener('DOMContentLoaded', function() {
            const inputsQuantite = document.querySelectorAll('input[type="number"]');
            const resumePanier = document.getElementById('resume-panier');
            const boutonCommander = document.getElementById('bouton-commander');
            
            function mettreAJourPanier() {
                let totalProduits = 0;
                let totalPrix = 0;
                let produitsSelectionnes = [];
                
                inputsQuantite.forEach(function(input) {
                    const quantite = parseInt(input.value) || 0;
                    if (quantite > 0) {
                        const produitCard = input.closest('.bg-white');
                        const nomProduit = produitCard.querySelector('h4').textContent;
                        const prixText = produitCard.querySelector('.text-green-600').textContent;
                        const prix = parseFloat(prixText.replace('€', '').replace(',', '.'));
                        
                        totalProduits += quantite;
                        totalPrix += prix * quantite;
                        produitsSelectionnes.push(`${nomProduit} x${quantite}`);
                    }
                });
                
                if (totalProduits > 0) {
                    resumePanier.innerHTML = `
                        <strong>Résumé:</strong><br>
                        ${produitsSelectionnes.join('<br>')}
                        <br><strong>Total: ${totalPrix.toFixed(2)} €</strong>
                    `;
                    boutonCommander.disabled = false;
                } else {
                    resumePanier.textContent = 'Sélectionnez des produits pour voir le résumé de votre commande.';
                    boutonCommander.disabled = true;
                }
            }
            
            inputsQuantite.forEach(function(input) {
                input.addEventListener('input', mettreAJourPanier);
            });
        });
    </script>
</body>
</html>

