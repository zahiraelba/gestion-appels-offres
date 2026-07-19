<x-app-layout>

<div class="min-h-screen bg-[#0B1120] text-gray-200 p-8">

    <div class="bg-[#1E293B] rounded-2xl shadow-lg">

        <div class="p-6 border-b border-gray-700">
            <h1 class="text-3xl font-bold text-white">
                Appels d'Offres
            </h1>
        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-[#0F172A]">
                    <tr>
                        <th class="text-left p-4">Titre</th>
                        <th class="text-left p-4">Statut</th>
                        <th class="text-left p-4">Date Limite</th>
                        <th class="text-left p-4">Action</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($appels as $appel)

                    <tr class="border-b border-gray-700 hover:bg-[#273449]">

                        <td class="p-4">
                            {{ $appel->titre }}
                        </td>

                        <td class="p-4">

                            @if($appel->statut == 'Ouvert')

                                <span class="px-4 py-1 rounded-full bg-green-600 text-white">
                                    {{ $appel->statut }}
                                </span>

                            @elseif($appel->statut == 'En cours')

                                <span class="px-4 py-1 rounded-full bg-yellow-500 text-black">
                                    {{ $appel->statut }}
                                </span>

                            @else

                                <span class="px-4 py-1 rounded-full bg-red-600 text-white">
                                    {{ $appel->statut }}
                                </span>

                            @endif

                        </td>

                        <td class="p-4">
                            {{ $appel->date_limite }}
                        </td>

                        <td class="p-4">

                             <a href="{{ route('offres.create', $appel->id) }}"
   class="bg-blue-600 text-white px-3 py-2 rounded">
    Participer
</a>

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>