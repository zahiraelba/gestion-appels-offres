<x-app-layout>

<div class="min-h-screen bg-slate-950 text-white p-8">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold">Documents des Fournisseurs</h1>
            <p class="text-slate-400">Gestion des documents soumis</p>
        </div>
    </div>

    <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-800 text-slate-300">
                <tr>
                    <th class="px-6 py-4 text-left">Fournisseur</th>
                    <th class="px-6 py-4 text-left">Document</th>
                    <th class="px-6 py-4 text-left">Nom du fichier</th>
                    <th class="px-6 py-4 text-center">Statut</th>
                    <th class="px-6 py-4 text-center">Télécharger</th>
                    <th class="px-6 py-4 text-center">Action</th>
                </tr>
            </thead>

            <tbody>

            @forelse($documents as $doc)

                <tr class="border-t border-slate-800 hover:bg-slate-800 transition">

                    <td class="px-6 py-4">
                        {{ $doc->fournisseur->nom ?? '---' }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $doc->type_document }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $doc->nom_fichier }}
                    </td>

                    <td class="px-6 py-4 text-center">

                        @if($doc->statut=="Accepté")

                            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-lg">
                                Accepté
                            </span>

                        @elseif($doc->statut=="Refusé")

                            <span class="bg-red-500/20 text-red-400 px-3 py-1 rounded-lg">
                                Refusé
                            </span>

                        @else

                            <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-lg">
                                En attente
                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-4 text-center">

                        <a href="{{ Storage::url($doc->chemin_fichier) }}"
                           target="_blank"
                           class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg">

                            Voir

                        </a>

                    </td>

                   <td class="px-6 py-4 text-center flex justify-center gap-2">

    <form action="{{ route('admin.documents.accepter', $doc->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <button type="submit"
            class="bg-green-600 hover:bg-green-700 px-3 py-2 rounded-lg">
            Accepter
        </button>
    </form>

    <form action="{{ route('admin.documents.refuser', $doc->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <button type="submit"
            class="bg-red-600 hover:bg-red-700 px-3 py-2 rounded-lg">
            Refuser
        </button>
    </form>

</td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center py-10 text-slate-400">

                        Aucun document disponible.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>