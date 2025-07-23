<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin - Eat&Drink</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Eat&Drink - Administration</h1>
            <form method="POST" action="{{ route('deconnexion') }}">
                @csrf
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded">
                    Se déconnecter
                </button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-2xl font-bold mb-6">Demandes de stand en attente</h2>
        
        @if (session('succes'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('succes') }}
            </div>
        @endif

        @if ($demandesEnAttente->count() > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entreprise</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date d'inscription</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($demandesEnAttente as $demande)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $demande->nom }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $demande->nom_entreprise ?? 'Non spécifié' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $demande->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $demande->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <form method="POST" action="{{ route('admin.approuver_demande', $demande) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded mr-2">
                                            Approuver
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.rejeter_demande', $demande) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded"
                                                onclick="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ?')">
                                            Rejeter
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <p class="text-gray-500">Aucune demande en attente d'approbation.</p>
            </div>
        @endif
    </div>
</body>
</html>

