<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Eat&Drink</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Inscription Entrepreneur</h2>
            
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $erreur)
                            <li>{{ $erreur }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('inscription') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom complet</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="nom_entreprise" class="block text-gray-700 text-sm font-bold mb-2">Nom de l'entreprise</label>
                    <input type="text" id="nom_entreprise" name="nom_entreprise" value="{{ old('nom_entreprise') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Adresse email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="mot_de_passe" class="block text-gray-700 text-sm font-bold mb-2">Mot de passe</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                </div>

                <div class="mb-6">
                    <label for="mot_de_passe_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirmer le mot de passe</label>
                    <input type="password" id="mot_de_passe_confirmation" name="mot_de_passe_confirmation" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                    S'inscrire
                </button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-gray-600">Déjà un compte ? 
                    <a href="{{ route('connexion') }}" class="text-blue-500 hover:text-blue-700">Se connecter</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>

