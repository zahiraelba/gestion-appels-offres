<x-app-layout>

<div class="min-h-screen bg-slate-950 text-white p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold">
                Liste des Appels d'Offres
            </h1>
            <p class="text-slate-400 text-sm">
                Gestion des appels d'offres
            </p>
        </div>

        <a href="{{ route('appels_offres.create') }}"
           class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded-xl">
            + Ajouter
        </a>
    </div>

    <!-- Tableau -->
    <div class="bg-slate-900 rounded-2xl border border-slate-800 p-6">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>
                    <tr class="border-b border-slate-700 text-slate-400">
                        <th class="text-left py-4">Référence</th>
                        <th class="text-left py-4">Titre</th>
                        <th class="text-left py-4">Statut</th>
                        <th class="text-left py-4">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($appels as $appel)
        
                    <tr class="border-b border-slate-800">

                        <td class="py-4">
                            {{ $appel->reference }}
                        </td>

                        <td class="py-4">
                            {{ $appel->titre }}
                        </td>

                        <td class="py-4">

                            @if($appel->statut == 'Ouvert')
                                <span class="bg-green-500/10 text-green-400 px-3 py-1 rounded-lg">
                                    Ouvert
                                </span>

                            @elseif($appel->statut == 'Terminé')
                                <span class="bg-red-500/10 text-red-400 px-3 py-1 rounded-lg">
                                    Terminé
                                </span>

                            @else
                                <span class="bg-yellow-500/10 text-yellow-400 px-3 py-1 rounded-lg">
                                    En cours
                                </span>
                            @endif

                        </td>
                        
                        <td class="py-4 flex gap-2">

                            <a href="{{ route('appels_offres.edit', $appel->id) }}"
                               class="bg-yellow-600 hover:bg-yellow-700 px-4 py-2 rounded-lg">
                                Modifier
                            </a>

                            <form action="{{ route('appels_offres.destroy', $appel->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Supprimer cet appel d''offre ?')"
                                        class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg">
                                    Supprimer
                                </button>
                                 <a href="{{ route('admin.commissions.create', $appel->id) }}"
   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
    Programmer une commission
</a>
                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4"
                            class="text-center py-8 text-slate-400">
                            Aucun appel d'offre disponible.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>