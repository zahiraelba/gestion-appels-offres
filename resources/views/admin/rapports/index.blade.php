<x-app-layout>

<div class="min-h-screen bg-slate-900 text-white p-8">

<div class="flex justify-between items-center mb-8">

    <h1 class="text-3xl font-bold">
         Rapports
    </h1>

    <div class="space-x-3">
        <button class="bg-red-600 px-4 py-2 rounded-lg">PDF</button>
        <a href="{{ route('rapports.export.excel') }}"
   class="bg-green-600 px-4 py-2 rounded-lg inline-block">
    Excel
</a>
        <button onclick="window.print()" 
class="bg-cyan-500 px-4 py-2 rounded-lg">
    Imprimer
</button>
    </div>

</div>

<!-- Cards -->

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

<div class="bg-slate-800 rounded-xl p-6 shadow">
    <p class="text-gray-400">Appels d'offres</p>
    <h2 class="text-4xl font-bold text-cyan-400 mt-3">
        {{ $totalAppels }}
    </h2>
</div>

<div class="bg-slate-800 rounded-xl p-6 shadow">
    <p class="text-gray-400">Offres reçues</p>
    <h2 class="text-4xl font-bold text-green-400 mt-3">
        {{ $totalOffres }}
    </h2>
</div>

<div class="bg-slate-800 rounded-xl p-6 shadow">
    <p class="text-gray-400">Invitations</p>
    <h2 class="text-4xl font-bold text-pink-400 mt-3">
        {{ $totalInvitations }}
    </h2>
</div>

<div class="bg-slate-800 rounded-xl p-6 shadow">
    <p class="text-gray-400">Fournisseurs</p>
    <h2 class="text-4xl font-bold text-yellow-400 mt-3">
        {{ $totalFournisseurs }}
    </h2>
</div>

</div>

<!-- Charts -->

<div class="grid lg:grid-cols-2 gap-6 mb-8">

<div class="bg-slate-800 rounded-xl p-6">

<h2 class="font-semibold mb-4">
Evolution des appels d'offres
</h2>

<canvas id="barChart"></canvas>

</div>

<div class="bg-slate-800 rounded-xl p-6">

<h2 class="font-semibold mb-4">
Répartition des statuts
</h2>

<canvas id="pieChart"></canvas>

</div>

</div>

<!-- Tableau -->

<div class="bg-slate-800 rounded-xl overflow-hidden">

<div class="p-5 border-b border-slate-700">

<h2 class="text-xl font-bold">
Résultat du rapport
</h2>

</div>

<table class="w-full">

<thead class="bg-slate-700">

<tr>

<th class="p-4 text-left">Référence</th>
<th class="text-left">Titre</th>
<th class="text-left">Budget</th>
<th class="text-left">Statut</th>
<th class="text-left">Date</th>

</tr>

</thead>

<tbody>

@foreach($derniers as $appel)

<tr class="border-b border-slate-700 hover:bg-slate-700">

<td class="p-4">{{ $appel->reference }}</td>
<td>{{ $appel->titre }}</td>
<td>{{ $appel->budget_estime }} DH</td>
<td>
    @if($appel->statut == 'Ouvert')
        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 font-semibold text-sm">
            ● Ouvert
        </span>

    @elseif($appel->statut == 'En cours')
        <span class="px-3 py-1 rounded-full bg-amber-100 text-amber-700 font-semibold text-sm">
            ● En cours
        </span>

    @else
        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold text-sm">
            ● Terminé
        </span>
    @endif
</td>
<td>{{ $appel->date_limite }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(document.getElementById('barChart'),{
type:'bar',
data:{
labels:['Jan','Fév','Mar','Avr','Mai','Jun'],
datasets:[{
data:[3,5,2,6,4,7]
}]
}
});

new Chart(document.getElementById('pieChart'), {
    type: 'doughnut',
    data: {
        labels: ['Ouvert', 'En cours', 'Terminé'],
        datasets: [{
            data: [
                {{ $ouverts }},
                {{ $encours }},
                {{ $termines }}
            ],
            backgroundColor: [
                '#f8a0a0', // Rose clair
                '#71c5f9', // Violet
                '#6d8f61'  // Teal
            ],
            borderColor: '#1E293B',
            borderWidth: 3,
            hoverOffset: 10
        }]
    },
    options: {
        plugins: {
            legend: {
                labels: {
                    color: '#E2E8F0'
                }
            }
        }
    }
});

</script>

</x-app-layout>