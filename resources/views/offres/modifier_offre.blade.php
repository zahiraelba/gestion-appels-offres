<x-app-layout>

<div class="min-h-screen bg-[#0B1120] py-10">

    <div class="max-w-4xl mx-auto">

        <div class="bg-[#1E293B] rounded-2xl shadow-xl border border-slate-700 p-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">
                    Modifier une offre
                </h1>

                <p class="text-slate-400 mt-2">
                    Modifiez les informations de votre offre.
                </p>
            </div>
            <form action="{{ route('offres.update', $offre->id) }}" method="POST">
    @csrf
    @method('PUT')

                <input type="hidden"
                       name="appel_offre_id"
                       value="{{ $offre->appel_offre_id }}">

                <!-- Titre -->
                <div class="mb-6">
                    <label class="block text-white mb-2">
                        Titre de l'offre
                    </label>

                    <input type="text"
                           name="titre"
                           value="{{ $offre->titre }}"
                           class="w-full bg-[#0F172A] border border-slate-600 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label class="block text-white mb-2">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="6"
                        class="w-full bg-[#0F172A] border border-slate-600 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">{{ $offre->description }}</textarea>
                </div>

                <!-- Montant -->
                <div class="mb-8">
                    <label class="block text-white mb-2">
                        Montant (DH)
                    </label>

                    <input type="number"
                           name="montant"
                           value="{{ $offre->montant }}"
                           class="w-full bg-[#0F172A] border border-slate-600 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                </div>

                <div class="flex justify-end gap-4">

                    <a href="{{ route('mes.offres') }}"
                       class="px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white rounded-xl transition">
                        Annuler
                    </a>

                    <button type="submit"
                            class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl font-semibold transition">
                        Modifier l'offre
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>