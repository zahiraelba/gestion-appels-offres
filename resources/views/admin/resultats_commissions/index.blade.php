<x-app-layout>

<div class="min-h-screen bg-slate-950 text-white p-8">

    <div class="max-w-7xl mx-auto">

        <div class="flex items-center justify-between mb-8">

            <div>
                <h1 class="text-3xl font-bold">
                    Gestion des résultats des commissions
                </h1>

                <p class="text-slate-400 mt-2">
                    Consultez et gérez les résultats des commissions.
                </p>
            </div>

            <a href="{{ route('resultats-commissions.create') }}"
               class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded-xl transition">
                Enregistrer un résultat
            </a>

        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-500/10 border border-green-500 text-green-300 rounded-xl p-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <p class="text-slate-400 text-sm">Total</p>
                <h2 class="text-3xl font-bold mt-2">{{ $totalResultats }}</h2>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <p class="text-slate-400 text-sm">Retenus</p>
                <h2 class="text-3xl font-bold text-green-400 mt-2">{{ $retenus }}</h2>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <p class="text-slate-400 text-sm">Non retenus</p>
                <h2 class="text-3xl font-bold text-yellow-400 mt-2">{{ $nonRetenus }}</h2>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <p class="text-slate-400 text-sm">Écartés</p>
                <h2 class="text-3xl font-bold text-red-400 mt-2">{{ $ecartes }}</h2>
            </div>

        </div>
        <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-xl overflow-hidden">

    <table class="w-full">

        <thead class="bg-slate-800 text-slate-300">

            <tr>
                <th class="px-6 py-4 text-left">Appel d'offre</th>
                <th class="px-6 py-4 text-left">Fournisseur</th>
                <th class="px-6 py-4 text-left">Statut</th>
                <th class="px-6 py-4 text-left">Observation</th>
                <th class="px-6 py-4 text-left">Date</th>
                <th class="px-6 py-4 text-center">Actions</th>
            </tr>

        </thead>

        <tbody>

        @forelse($resultats as $resultat)
        <tr class="border-t border-slate-800 hover:bg-slate-800 transition">

    <td class="px-6 py-4">
        {{ $resultat->commission->appelOffre->titre ?? '-' }}
    </td>

    <td class="px-6 py-4">
        {{ $resultat->fournisseur->nom ?? '-' }}
    </td>

    <td class="px-6 py-4">

        @if($resultat->statut == 'Retenu')

            <span class="px-3 py-1 rounded-full bg-green-600 text-white text-sm">
                Retenu
            </span>

        @elseif($resultat->statut == 'Non retenu')

            <span class="px-3 py-1 rounded-full bg-yellow-500 text-black text-sm">
                Non retenu
            </span>

        @else

            <span class="px-3 py-1 rounded-full bg-red-600 text-white text-sm">
                Écarté
            </span>

        @endif

    </td>

    <td class="px-6 py-4">
        {{ $resultat->observation ?? '-' }}
    </td>

    <td class="px-6 py-4">
        {{ $resultat->created_at->format('d/m/Y') }}
    </td>

    <td class="px-6 py-4 text-center">

        <div class="flex justify-center gap-2">

            <a href="{{ route('resultats-commissions.edit', $resultat->id) }}"
               class="bg-yellow-600 hover:bg-yellow-700 px-4 py-2 rounded-lg">
                Modifier
            </a>

            <form action="{{ route('resultats-commissions.destroy', $resultat->id) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <button type="submit"
                        onclick="return confirm('Supprimer ce résultat ?')"
                        class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg">
                    Supprimer
                </button>

            </form>

        </div>

    </td>

</tr>
@empty

<tr>
    <td colspan="6" class="text-center py-10 text-slate-400">
        Aucun résultat enregistré.
    </td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

</x-app-layout>