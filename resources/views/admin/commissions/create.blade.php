<x-app-layout>

<div class="min-h-screen bg-slate-950 text-white p-8">

    <div class="max-w-3xl mx-auto">

        <div class="bg-slate-900 rounded-2xl border border-slate-800 p-8 shadow-xl">

            <h1 class="text-3xl font-bold mb-2">
                Programmer une commission
            </h1>

            <p class="text-slate-400 mb-8">
                Définissez la date, l'heure et le lieu de la commission.
            </p>

            @if ($errors->any())
                <div class="mb-6 bg-red-500/10 border border-red-500 text-red-300 rounded-lg p-4">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('commissions.store') }}" method="POST">

                @csrf

                <input
                    type="hidden"
                    name="appel_offre_id"
                    value="{{ $appelOffre->id }}">

                <div class="mb-6">

                    <label class="block mb-2 font-medium">
                        Date de la commission
                    </label>

                    <input
                        type="date"
                        name="date_commission"
                        value="{{ old('date_commission') }}"
                        class="w-full rounded-xl bg-slate-800 border border-slate-700 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <div class="mb-6">

                    <label class="block mb-2 font-medium">
                        Heure
                    </label>

                    <input
                        type="time"
                        name="heure"
                        value="{{ old('heure') }}"
                        step="60"
                        required
                        class="w-full rounded-xl bg-slate-800 border border-slate-700 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <div class="mb-8">

                    <label class="block mb-2 font-medium">
                        Lieu de la commission
                    </label>
                    
                    <input
                        type="text"
                        name="lieu"
                        value="{{ old('lieu') }}"
                        placeholder="Ex : Salle de réunion 01"
                        class="w-full rounded-xl bg-slate-800 border border-slate-700 text-white px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

<div class="mb-8">

    <label class="block mb-4 font-medium">
        Participants de la commission
    </label>

    <div id="participants">

        <div class="participant grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            <select
    name="participants[0][user_id]"
    class="rounded-xl bg-slate-700 border border-slate-600 text-white px-4 py-3">

    <option value="">Sélectionner un membre</option>

    @foreach($membres as $membre)
        <option value="{{ $membre->id }}">
            {{ $membre->name }}
        </option>
    @endforeach

</select>
            <input
                type="text"
                name="participants[0][prenom]"
                placeholder="Prénom"
                class="rounded-xl bg-slate-700 border border-slate-600 text-white px-4 py-3">

            <input
                type="text"
                name="participants[0][nom]"
                placeholder="Nom"
                class="rounded-xl bg-slate-700 border border-slate-600 text-white px-4 py-3">

            <input
                type="text"
                name="participants[0][fonction]"
                placeholder="Fonction"
                class="rounded-xl bg-slate-700 border border-slate-600 text-white px-4 py-3">

            <input
                type="text"
                name="participants[0][matricule]"
                placeholder="Matricule"
                class="rounded-xl bg-slate-700 border border-slate-600 text-white px-4 py-3">

        </div>

    </div>

    <button type="button"
        onclick="addParticipant()"
        class="mt-3 bg-blue-600 px-4 py-2 rounded-lg">
        + Ajouter un participant
    </button>

</div>



<script>
let index = 1;

function addParticipant(){

    let html = `
    <div class="participant grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">

        <input
            type="text"
            name="participants[${index}][prenom]"
            placeholder="Prénom"
            class="rounded-xl bg-slate-700 border border-slate-600 text-white px-4 py-3">

        <input
            type="text"
            name="participants[${index}][nom]"
            placeholder="Nom"
            class="rounded-xl bg-slate-700 border border-slate-600 text-white px-4 py-3">

        <input
            type="text"
            name="participants[${index}][fonction]"
            placeholder="Fonction"
            class="rounded-xl bg-slate-700 border border-slate-600 text-white px-4 py-3">

        <input
            type="text"
            name="participants[${index}][matricule]"
            placeholder="Matricule"
            class="rounded-xl bg-slate-700 border border-slate-600 text-white px-4 py-3">

    </div>
    `;

    document.getElementById('participants')
        .insertAdjacentHTML('beforeend', html);

    index++;
}
</script>
                <div class="flex justify-end gap-4">

                    <a href="{{ route('dashboard') }}"
                       class="px-6 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 transition">

                        Annuler

                    </a>

                    <button
                        type="submit"
                        class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 transition font-semibold">

                        Enregistrer la commission

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>