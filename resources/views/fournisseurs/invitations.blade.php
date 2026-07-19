<x-app-layout>

<div class="min-h-screen bg-[#0B1120] text-white p-8">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold">Mes Invitations</h1>
            <p class="text-gray-400 mt-1">
                Liste des invitations reçues.
            </p>
        </div>
    </div>

    <div class="bg-[#1E293B] rounded-2xl shadow-lg overflow-hidden">

        <div class="p-6 border-b border-gray-700">
            <h2 class="text-xl font-semibold">
                Invitations Disponibles
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-[#0F172A]">
                    <tr>
                        <th class="text-left p-4">ID</th>
                        <th class="text-left p-4">Objet</th>
                        <th class="text-left p-4">Date</th>
                        <th class="text-left p-4">Statut</th>
                        <th class="text-left p-4">Action</th>
                    </tr>
                </thead>

                <tbody>
                  
                    @forelse($invitations as $invitation)

                    <tr class="border-b border-gray-700 hover:bg-[#273449]">

                        <td class="p-4">
                            #{{ $invitation->id }}
                        </td>

                        <td class="p-4">
                            {{ $invitation->objet ?? 'Invitation fournisseur' }}
                        </td>

                        <td class="p-4">
                            {{ $invitation->created_at->format('d/m/Y') }}
                        </td>

                        <td class="p-4">

                            @if(($invitation->statut ?? 'En attente') == 'Acceptée')

                                <span class="bg-green-600 px-3 py-1 rounded-full text-sm">
                                    Acceptée
                                </span>

                            @elseif(($invitation->statut ?? '') == 'Refusée')

                                <span class="bg-red-600 px-3 py-1 rounded-full text-sm">
                                    Refusée
                                </span>

                            @else

                                <span class="bg-yellow-500 text-black px-3 py-1 rounded-full text-sm">
                                    En attente
                                </span>

                            @endif

                        </td>

                        <td class="p-4 flex gap-2">

    <form action="{{ route('invitations.accepter', $invitation->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit"
                class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg">
            Accepter
        </button>
    </form>

    <form action="{{ route('invitations.refuser', $invitation->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit"
                class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg">
            Refuser
        </button>
    </form>

</td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center p-8 text-gray-400">
                            Aucune invitation disponible.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>