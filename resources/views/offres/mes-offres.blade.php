<x-app-layout>

<div class="min-h-screen bg-[#0B1120] text-gray-200 flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-[#111827] border-r border-gray-800">

        <div class="p-6 border-b border-gray-800">
            <h1 class="text-2xl font-bold text-white">
                Gestion des Appels d'Offres
            </h1>

            <p class="text-gray-400 text-sm mt-1">
                Fournisseur Panel
            </p>
        </div>

        <nav class="mt-6 px-4">

            <a href="{{ route('fournisseur.dashboard') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-xl hover:bg-gray-800">
                Dashboard
            </a>

            <a href="{{ route('appels.index') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-xl hover:bg-gray-800">
                Appels d'Offres
            </a>

            <a href="{{ route('mes.offres') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-xl bg-blue-600 text-white">
                Mes Offres
            </a>

            <a href="{{ route('mes.invitations') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-xl hover:bg-gray-800">
                Invitations
            </a>

            <a href="{{ route('profile.edit') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-xl hover:bg-gray-800">
                Profil
            </a>

        </nav>

    </aside>

    <!-- Contenu -->
    <main class="flex-1 p-8">

        <div class="flex justify-between items-center mb-8">

            <div>
                <h2 class="text-3xl font-bold text-white">
                    Mes Offres
                </h2>

                <p class="text-gray-400">
                    Liste de toutes vos offres envoyées.
                </p>
            </div>

        </div>
       
           <div class="bg-[#1E293B] rounded-2xl shadow-xl overflow-hidden">

            <div class="p-6 border-b border-gray-700">
                <h3 class="text-xl font-semibold text-white">
                    Historique des Offres
                </h3>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-[#0F172A] text-gray-300">

                        <tr>

                            <th class="p-4 text-left">ID</th>

                            <th class="p-4 text-left">Titre</th>

                            <th class="p-4 text-left">Montant</th>

                            <th class="p-4 text-left">Date</th>

                            <th class="p-4 text-left">Statut</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($offres as $offre)

                        <tr class="border-b border-gray-700 hover:bg-[#273449]">

                            <td class="p-4">
                                {{ $offre->id }}
                            </td>

                            <td class="p-4">
                                {{ $offre->titre }}
                            </td>

                            <td class="p-4 text-cyan-400 font-bold">
                                {{ number_format($offre->montant,2,',',' ') }} DH
                            </td>

                            <td class="p-4">
                                {{ $offre->created_at->format('d/m/Y') }}
                            </td>

                            <td class="p-4">

                                <span class="bg-green-600 px-3 py-1 rounded-full text-sm">
                                    Envoyée
                                </span>

                            </td>
                           
                        </tr>
                           <th class="px-6 py-3 text-center">Actions</th>
                           <td class="px-6 py-4">
    <div class="flex gap-2 justify-center">

        <a href="{{ route('offres.edit', $offre->id) }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-lg text-sm font-semibold">
            Modifier
        </a>

        <form action="{{ route('offres.destroy', $offre->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit"
                onclick="return confirm('Supprimer cette offre ?')"
                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-sm font-semibold">
                Supprimer
            </button>
        </form>

    </div>
</td>
                        @empty

                        <tr>

                            <td colspan="5" class="text-center py-10 text-gray-400">

                                Aucune offre envoyée.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</x-app-layout>