<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En attente d'approbation - Eat&Drink</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md text-center">
            <div class="mb-6">
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Demande en cours de traitement</h2>
            </div>
            
            <p class="text-gray-600 mb-6">
                Votre demande de stand pour l'événement Eat&Drink est actuellement en attente d'approbation par notre équipe administrative.
            </p>
            
            <p class="text-gray-600 mb-6">
                Vous recevrez une notification par email dès que votre demande sera traitée.
            </p>

            <form method="POST" action="{{ route('deconnexion') }}">
                @csrf
                <button type="submit" class="bg-gray-500 text-white py-2 px-4 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                    Se déconnecter
                </button>
            </form>
        </div>
    </div>
</body>
</html>

