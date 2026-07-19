<x-app-layout>

<div class="min-h-screen bg-slate-950 text-white p-8">

    <div class="max-w-7xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold">
                Liste des commissions
            </h1>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-500/10 border border-green-500 text-green-300 rounded-xl p-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-xl overflow-hidden">

            <table class="w-full">

                <thead class="bg-slate-800 text-slate-300">

                    <tr>
                        <th class="px-6 py-4 text-left">ID</th>
                        <th class="px-6 py-4 text-left">Appel d'offre</th>
                        <th class="px-6 py-4 text-left">Date</th>
                        <th class="px-6 py-4 text-left">Heure</th>
                        <th class="px-6 py-4 text-left">Lieu</th>
                        <th class="px-6 py-4 text-left">Statut</th>
                        <th class="px-6 py-4 text-left">Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($commissions as $commission)

                        <tr class="border-t border-slate-800 hover:bg-slate-800 transition">

                            <td class="px-6 py-4">
                                {{ $commission->id }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $commission->appelOffre->objet ?? '---' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $commission->date_commission }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $commission->heure }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $commission->lieu }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full bg-blue-600 text-white text-sm">
                                    {{ $commission->statut }}
                                </span>
                            </td>
                            <td class="py-4 flex gap-2">

    <a href="{{ route('admin.commissions.edit', $commission->id) }}"
       class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg">
        Modifier
    </a>

    <form action="{{ route('admin.commissions.destroy', $commission->id) }}"
          method="POST">
        @csrf
        @method('DELETE')

        <button type="submit"
                onclick="return confirm('Supprimer cette commission ?')"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
            Supprimer
        </button>
    </form>

</td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-400">
                                Aucune commission programmée.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>