<x-app-layout>

<div class="p-8 bg-[#0F172A] min-h-screen">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white">
                Liste des Fournisseurs
            </h1>

            <p class="text-gray-400 mt-2">
                Dashboard / Fournisseurs
            </p>
        </div>

        <a href="{{ route('fournisseurs.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold shadow-lg transition">
            + Ajouter
        </a>
    </div>

    <div class="bg-[#111C2D] border border-slate-700 rounded-2xl shadow-xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-[#1A2942] text-gray-300 uppercase text-sm">
                <tr>
                    <th class="px-6 py-4 text-left">ID</th>
                    <th class="px-6 py-4 text-left">Nom</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Téléphone</th>
                    <th class="px-6 py-4 text-left">Adresse</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($fournisseurs as $fournisseur)

                <tr class="border-b border-slate-700 hover:bg-[#1A2942] transition">

                    <td class="px-6 py-4 text-white font-semibold">
                        {{ $fournisseur->id }}
                    </td>

                    <td class="px-6 py-4 text-white">
                        {{ $fournisseur->nom }}
                    </td>

                    <td class="px-6 py-4 text-gray-300">
                        {{ $fournisseur->email }}
                    </td>

                    <td class="px-6 py-4 text-gray-300">
                        {{ $fournisseur->telephone }}
                    </td>

                    <td class="px-6 py-4 text-gray-300">
                        {{ $fournisseur->adresse }}
                    </td>

                    <td class="px-6 py-4 flex justify-center gap-3">

                        <a href="{{ route('fournisseurs.edit',$fournisseur->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                            Modifier
                        </a>

                        <form action="{{ route('fournisseurs.destroy',$fournisseur->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Supprimer ce fournisseur ?')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                                Supprimer
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center py-10 text-gray-400">

                        Aucun fournisseur disponible.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>