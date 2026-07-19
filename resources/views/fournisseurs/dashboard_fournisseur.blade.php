<x-app-layout>

<div class="min-h-screen bg-[#0B1120] text-gray-200 flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-[#111827] border-r border-gray-800">

        <div class="p-6 border-b border-gray-800">
            <h1 class="text-2xl font-bold text-white">
                Gestion des Appels d'offres
            </h1>
            <p class="text-gray-400 text-sm mt-1">
                Fournisseur Panel
            </p>
        </div>

        <nav class="mt-6 px-4">

            <a href="{{ route('fournisseur.dashboard') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-xl bg-blue-600 text-white">
                Dashboard
            </a>

            <a href="{{ route('appels.index') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-xl hover:bg-gray-800 transition">
                Appels d'Offres
            </a>

            <a href="{{ route('mes.offres') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-xl hover:bg-gray-800 transition">
                Mes Offres
            </a>

            <a href="{{ route('mes.invitations') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-xl hover:bg-gray-800 transition">
                Invitations
            </a>
            <a href="{{ route('documents.index') }}"
   class="flex items-center px-4 py-3 mb-2 rounded-xl hover:bg-gray-800 transition">
    Mes Documents
</a>
            <a href="{{ route('profile.edit') }}"
               class="flex items-center px-4 py-3 mb-2 rounded-xl hover:bg-gray-800 transition">
                Profil
            </a>

        </nav>

    </aside>

    <!-- Main -->
    <main class="flex-1 p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">

            <div>
                <h2 class="text-3xl font-bold text-white">
                    Dashboard Fournisseur
                </h2>

                <p class="text-gray-400 mt-1">
                    Bienvenue dans votre espace {{ Auth::user()->name }}
                </p>
            </div>

        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

            <div class="bg-[#1E293B] rounded-2xl p-6 shadow-lg">
                <h3 class="text-gray-400">
                    Mes Offres
                </h3>

                <p class="text-4xl font-bold mt-4 text-white">
                    {{ $totalOffres }}
                </p>
            </div>

            <div class="bg-[#1E293B] rounded-2xl p-6 shadow-lg">
                <h3 class="text-gray-400">
                    Invitations
                </h3>

                <p class="text-4xl font-bold mt-4 text-white">
                    {{ $totalInvitations }}
                </p>
            </div>

            <div class="bg-[#1E293B] rounded-2xl p-6 shadow-lg">
                <h3 class="text-gray-400">
                    Appels Actifs
                </h3>

                <p class="text-4xl font-bold mt-4 text-white">
                    {{ $totalAppelsOffres }}
                </p>
            </div>

            <div class="bg-[#1E293B] rounded-2xl p-6 shadow-lg">
                <h3 class="text-gray-400">
                    Appels en cours
                </h3>

                <p class="text-4xl font-bold mt-4 text-white">
                    {{ $totalEnCours }}
                </p>
            </div>

        </div>

        <!-- Table -->
        <div class="bg-[#1E293B] rounded-2xl shadow-lg">

            <div class="p-6 border-b border-gray-700">
                <h3 class="text-xl font-semibold text-white">
                    Derniers Appels d'Offres
                </h3>
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

                    @foreach($derniersAppels as $appel)

                        <tr class="border-b border-gray-700 hover:bg-[#273449]">

                            <td class="p-4">
                                {{ $appel->titre }}
                            </td>

                            <td class="p-4">

    @if($appel->statut == 'Ouvert')

        <span class="px-4 py-1 rounded-full text-sm bg-green-600 text-white">
            {{ $appel->statut }}
        </span>

    @elseif($appel->statut == 'En cours')

        <span class="px-4 py-1 rounded-full text-sm bg-yellow-500 text-black">
            {{ $appel->statut }}
        </span>

    @elseif($appel->statut == 'Terminé')

        <span class="px-4 py-1 rounded-full text-sm bg-red-600 text-white">
            {{ $appel->statut }}
        </span>

    @else

        <span class="px-4 py-1 rounded-full text-sm bg-gray-600 text-white">
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

    </main>

</div>

</x-app-layout>