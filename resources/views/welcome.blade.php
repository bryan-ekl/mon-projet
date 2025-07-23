<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eat&Drink - Événement Culinaire</title>
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

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-orange-500 to-red-600 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-5xl font-bold mb-6">Bienvenue à Eat&Drink</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                L'événement culinaire qui rassemble les meilleurs entrepreneurs, restaurateurs et artisans. 
                Découvrez des saveurs exceptionnelles et passez commande directement auprès de nos exposants.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('exposants.liste') }}" class="bg-white text-orange-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Découvrir nos exposants
                </a>
                <a href="{{ route('inscription') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-orange-600 transition-colors">
                    Devenir exposant
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-800 mb-4">Pourquoi choisir Eat&Drink ?</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Notre plateforme moderne facilite les échanges entre exposants et visiteurs pour une expérience culinaire unique.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Exposants Vérifiés</h4>
                    <p class="text-gray-600">Tous nos exposants sont soigneusement sélectionnés et approuvés par notre équipe.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m6 0V9a2 2 0 00-2-2H9a2 2 0 00-2-2v6"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Commande Facile</h4>
                    <p class="text-gray-600">Passez vos commandes directement en ligne auprès de vos exposants préférés.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Communauté Active</h4>
                    <p class="text-gray-600">Rejoignez une communauté passionnée d'entrepreneurs et de gourmets.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gray-800 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold mb-4">Prêt à rejoindre l'aventure ?</h3>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Que vous soyez visiteur ou entrepreneur, Eat&Drink vous offre une expérience culinaire unique.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('exposants.liste') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                    Explorer les stands
                </a>
                <a href="{{ route('inscription') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-gray-800 transition-colors">
                    Devenir exposant
                </a>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 Eat&Drink. Tous droits réservés.</p>
            <p class="text-gray-400 mt-2">L'événement culinaire qui rassemble les passionnés de gastronomie.</p>
        </div>
    </footer>
</body>
</html>

