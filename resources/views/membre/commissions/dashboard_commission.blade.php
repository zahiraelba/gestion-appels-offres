<x-app-layout>

<div class="min-h-screen bg-slate-950 text-white p-8">

    <div class="max-w-7xl mx-auto">

        <div class="mb-8">
            <h1 class="text-4xl font-bold">
                Mes Commissions
            </h1>

            <p class="text-slate-400 mt-2">
                Consultez toutes les commissions auxquelles vous participez.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <p class="text-slate-400 text-sm">
                    Total des commissions
                </p>

                <h2 class="text-4xl font-bold text-blue-400 mt-2">
                    {{ $commissions->count() }}
                </h2>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <p class="text-slate-400 text-sm">
                    Programmées
                </p>

                <h2 class="text-4xl font-bold text-cyan-400 mt-2">
                    {{ $commissions->where('statut','Programmée')->count() }}
                </h2>
            </div>

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
                <p class="text-slate-400 text-sm">
                    Terminées
                </p>

                <h2 class="text-4xl font-bold text-emerald-400 mt-2">
                    {{ $commissions->where('statut','Terminée')->count() }}
                </h2>
            </div>

        </div>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-800">
                <h2 class="text-xl font-semibold">
                    Liste des commissions
                </h2>
            </div>

            @if($commissions->isEmpty())

                <div class="p-12 text-center">

                    <div class="text-6xl mb-4">
                        📋
                    </div>

                    <h3 class="text-xl font-semibold mb-2">
                        Aucune commission
                    </h3>

                    <p class="text-slate-400">
                        Vous n'êtes affecté à aucune commission.
                    </p>

                </div>

            @else

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-800">

                        <tr>

                            <th class="px-6 py-4 text-left">
                                Appel d'offre
                            </th>

                            <th class="px-6 py-4 text-left">
                                Date
                            </th>

                            <th class="px-6 py-4 text-left">
                                Heure
                            </th>

                            <th class="px-6 py-4 text-left">
                                Lieu
                            </th>

                            <th class="px-6 py-4 text-center">
                                Statut
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @foreach($commissions as $commission)

                    <tr class="border-t border-slate-800 hover:bg-slate-800/40 transition">

                        <td class="px-6 py-5 font-medium">
                            {{ $commission->appelOffre->titre }}
                        </td>

                        <td class="px-6 py-5">
                            {{ \Carbon\Carbon::parse($commission->date_commission)->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-5">
                            {{ substr($commission->heure,0,5) }}
                        </td>

                        <td class="px-6 py-5">
                            {{ $commission->lieu }}
                        </td>

                        <td class="px-6 py-5 text-center">

                            @if($commission->statut=="Programmée")

                                <span class="px-4 py-2 rounded-full bg-blue-600 text-sm">
                                    Programmée
                                </span>

                            @else

                                <span class="px-4 py-2 rounded-full bg-emerald-600 text-sm">
                                    Terminée
                                </span>

                            @endif

                        </td>

                    </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

            @endif

        </div>

    </div>

</div>

</x-app-layout>