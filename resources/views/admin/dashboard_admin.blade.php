<x-app-layout>


    <div class="flex min-h-screen bg-slate-950 text-white">
<!-- Sidebar -->
<div class="w-64 bg-slate-900 border-r border-slate-800 p-6">

    <h2 class="text-2xl font-bold text-blue-500 mb-8">
        Admin
    </h2>

    <div class="space-y-3">

        <a href="{{ route('dashboard') }}"
           class="block px-4 py-3 rounded-xl hover:bg-slate-800">
            Dashboard
        </a>

        <a href="{{ route('appels_offres.index') }}"
           class="block px-4 py-3 rounded-xl hover:bg-slate-800">
            Appels d'Offres
        </a>

        <a href="{{ route('fournisseurs.index') }}"
           class="block px-4 py-3 rounded-xl hover:bg-slate-800">
            Fournisseurs
        </a>

        <a href="{{ route('invitations.index') }}"
           class="block px-4 py-3 rounded-xl hover:bg-slate-800">
            Invitations
        </a>
        <a href="{{ route('admin.commissions.index') }}"
   class="block px-4 py-3 rounded-xl hover:bg-slate-800 transition">
    Commissions
</a>
<a href="{{ route('resultats-commissions.index') }}"
   class="block px-4 py-3 rounded-xl hover:bg-slate-800 transition
   {{ request()->routeIs('admin.resultats-commissions.') ? 'bg-slate-800 text-blue-400 font-semibold' : '' }}">
    Résultats des commissions
</a>
        <a href="{{ route('admin.rapports.index') }}"
           class="block px-4 py-3 rounded-xl hover:bg-slate-800">
            Rapports
        </a>

        <a href="{{ route('admin.documents.index') }}"
           class="block px-4 py-3 rounded-xl hover:bg-slate-800">
            Documents
        </a>

    </div>

</div>
<div class="flex-1 p-6">
<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <p class="text-slate-400">
            Gestion des Appels d'Offres
        </p>
    </div>

    <div class="flex items-center gap-3">

        <div class="bg-slate-900 px-4 py-2 rounded-xl border border-slate-800">
            {{ Auth::user()->name }}
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-xl">
                Déconnexion
            </button>
        </form>

    </div>

</div>
<div class="flex-1 p-6">
</div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

        <div class="bg-slate-900 rounded-2xl p-5 border border-slate-800">
            <h3 class="text-slate-400 text-sm mb-2">
                Total Appels d'Offres
            </h3>
            <p class="text-3xl font-bold">
                {{ $totalAppelsOffres ?? 0 }}
            </p>
        </div>

        <div class="bg-slate-900 rounded-2xl p-5 border border-slate-800">
            <h3 class="text-slate-400 text-sm mb-2">
                Total Fournisseurs
            </h3>
            <p class="text-3xl font-bold">
                {{ $totalFournisseurs ?? 0 }}
            </p>
        </div>

        <div class="bg-slate-900 rounded-2xl p-5 border border-slate-800">
            <h3 class="text-slate-400 text-sm mb-2">
                Offres Reçues
            </h3>
            <p class="text-3xl font-bold">
                {{ $totalOffres ?? 0 }}
            </p>
        </div>

        <div class="bg-slate-900 rounded-2xl p-5 border border-slate-800">
            <h3 class="text-slate-400 text-sm mb-2">
                Appels en Cours
            </h3>
            <p class="text-3xl font-bold">
                {{ $totalEnCours ?? 0 }}
            </p>
        </div>

    </div>
    <!-- Graphiques -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    <!-- Graphique 1 -->
    <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">

        <h2 class="text-lg font-semibold mb-6">
            Appels d'Offres par mois
        </h2>

        <div class="flex items-end justify-between h-52">

            <div class="flex flex-col items-center">
                <div class="bg-blue-600 w-8 h-20 rounded-t"></div>
                <span class="text-xs mt-2">Jan</span>
            </div>

            <div class="flex flex-col items-center">
                <div class="bg-blue-600 w-8 h-32 rounded-t"></div>
                <span class="text-xs mt-2">Fév</span>
            </div>

            <div class="flex flex-col items-center">
                <div class="bg-blue-600 w-8 h-24 rounded-t"></div>
                <span class="text-xs mt-2">Mar</span>
            </div>

            <div class="flex flex-col items-center">
                <div class="bg-blue-600 w-8 h-40 rounded-t"></div>
                <span class="text-xs mt-2">Avr</span>
            </div>

            <div class="flex flex-col items-center">
                <div class="bg-blue-600 w-8 h-28 rounded-t"></div>
                <span class="text-xs mt-2">Mai</span>
            </div>

            <div class="flex flex-col items-center">
                <div class="bg-blue-600 w-8 h-48 rounded-t"></div>
                <span class="text-xs mt-2">Juin</span>
            </div>

        </div>

    </div>

    <!-- Graphique 2 -->
    <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">

        <h2 class="text-lg font-semibold mb-6">
            Répartition des Statuts
        </h2>

        <div class="space-y-5">

            <div>
                <div class="flex justify-between mb-1">
                    <span>Ouvert</span>
                    <span>{{ $statutsCounts['Ouvert'] ?? 0 }}</span>
                </div>

                <div class="w-full bg-slate-800 rounded-full h-3">
                    <div class="bg-green-500 h-3 rounded-full w-1/2"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between mb-1">
                    <span>En cours</span>
                    <span>{{ $statutsCounts['En cours'] ?? 0 }}</span>
                </div>

                <div class="w-full bg-slate-800 rounded-full h-3">
                    <div class="bg-yellow-500 h-3 rounded-full w-1/2"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between mb-1">
                    <span>Terminé</span>
                    <span>{{ $statutsCounts['Terminé'] ?? 0 }}</span>
                </div>

                <div class="w-full bg-slate-800 rounded-full h-3">
                    <div class="bg-red-500 h-3 rounded-full w-1/2"></div>
                </div>
            </div>

        </div>

    </div>

</div>

    <!-- Contenu principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Tableau -->
        <div class="lg:col-span-2 bg-slate-900 rounded-2xl p-6 border border-slate-800">

            <div class="flex justify-between items-center mb-5">
                <h2 class="text-xl font-semibold">
                    Derniers Appels d'Offres
                </h2>

                <a href="{{ route('appels_offres.index') }}"
                   class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm">
                    Voir tout
                </a>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>
                        <tr class="border-b border-slate-700 text-slate-400">
                            <th class="text-left py-3">Référence</th>
                            <th class="text-left py-3">Titre</th>
                            <th class="text-left py-3">Date Limite</th>
                            <th class="text-left py-3">Statut</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($derniersAppels as $ao)

                        <tr class="border-b border-slate-800">

                            <td class="py-4">{{ $ao->reference }}</td>

                            <td class="py-4">{{ $ao->titre }}</td>

                            <td class="py-4">
                                {{ \Carbon\Carbon::parse($ao->date_limite)->format('d/m/Y') }}
                            </td>

                            <td class="py-4">

                                @if($ao->statut == 'Ouvert')
                                    <span class="bg-green-500/10 text-green-400 px-3 py-1 rounded-lg">
                                        Ouvert
                                    </span>

                                @elseif($ao->statut == 'Terminé')
                                    <span class="bg-red-500/10 text-red-400 px-3 py-1 rounded-lg">
                                        Terminé
                                    </span>

                                @else
                                    <span class="bg-yellow-500/10 text-yellow-400 px-3 py-1 rounded-lg">
                                        En cours
                                    </span>
                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="4" class="text-center py-8 text-slate-400">
                                Aucun appel d'offre disponible.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <!-- Actions rapides -->
        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">

            <h2 class="text-xl font-semibold mb-5">
                Actions Rapides
            </h2>

            <div class="space-y-4">

                <a href="{{ route('appels_offres.create') }}"
                   class="block bg-blue-600 hover:bg-blue-700 p-4 rounded-xl text-center">
                    Ajouter un Appel d'Offre
                </a>

                <a href="{{ route('appels_offres.index') }}"
                   class="block bg-slate-800 hover:bg-slate-700 p-4 rounded-xl text-center">
                    Consulter les Appels d'Offres
                </a>

               <a href="{{ route('fournisseurs.index') }}"
   class="block bg-slate-800 hover:bg-slate-700 p-4 rounded-xl text-center">
    Gérer les Fournisseurs
</a>
                <a href="{{ route('invitations.index') }}"
   class="block bg-slate-800 hover:bg-slate-700 p-4 rounded-xl text-center">
    envoyer une invitation
</a>
                <a href="{{ route('admin.rapports.index') }}"
   class="block bg-slate-800 hover:bg-slate-700 p-4 rounded-xl text-center">
    Consulter les Rapports
</a>

            </div>

        </div>

    </div>

    <!-- Notifications -->
    <div class="mt-8 bg-slate-900 rounded-2xl p-6 border border-slate-800">

        <h2 class="text-xl font-semibold mb-5">
            Notifications Récentes
        </h2>

        <div class="space-y-3">

            <div class="bg-slate-800 p-4 rounded-xl">
                Aucun nouvel événement.
            </div>

            <div class="bg-slate-800 p-4 rounded-xl">
                Les notifications système apparaîtront ici.
            </div>

        </div>

    </div>

</div>
</div>
</div>

</x-app-layout>