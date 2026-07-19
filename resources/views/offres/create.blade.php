<x-app-layout>

<div class="min-h-screen bg-[#0B1120] py-10">

    <div class="max-w-4xl mx-auto">

        <div class="bg-[#1E293B] rounded-2xl shadow-xl border border-slate-700 p-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">
                    Participer à un Appel d'Offre
                </h1>

                <p class="text-slate-400 mt-2">
                    Remplissez les informations de votre offre.
                </p>
            </div>

           <form action="{{ route('offres.store') }}" method="POST">
    @csrf
   
                <input type="hidden"
                       name="appel_offre_id"
                       value="{{ $appel->id }}">

                <!-- Titre -->
                <div class="mb-6">
                    <label class="block text-white mb-2">
                        Titre de l'offre
                    </label>

                    <input type="text"
                           name="titre"
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
                        class="w-full bg-[#0F172A] border border-slate-600 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500"></textarea>
                </div>

                <!-- Montant -->
                <div class="mb-8">
                    <label class="block text-white mb-2">
                        Montant (DH)
                    </label>

                    <input type="number"
                           name="montant"
                           class="w-full bg-[#0F172A] border border-slate-600 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                </div>

                <div class="flex justify-end gap-4">

                    <a href="{{ route('fournisseur.dashboard') }}"
                       class="px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white rounded-xl transition">
                        Annuler
                    </a>

                    <button type="submit"
                            class="px-6 py-3 bg-cyan-600 hover:bg-cyan-700 text-white rounded-xl font-semibold transition">
                        Envoyer l'offre
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>