<x-app-layout>

<div class="min-h-screen bg-[#020617] p-8"> 

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-sky-300">
            Ajouter un Fournisseur
        </h1>

        <p class="text-sky-300 mt-2">
            Dashboard / Fournisseurs / Ajouter
        </p>
    </div>
    <div class="max-w-4xl bg-[#0f172a] rounded-2xl border border-sky-900 shadow-xl p-8">

        <h2 class="text-2xl font-semibold text-sky-300 mb-6">
            Informations du Fournisseur
        </h2>

        <form action="{{ route('fournisseurs.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-sky-300 mb-2">
                    Nom du fournisseur
                </label>

                <input type="text"
                       name="nom"
                       required
                       placeholder="Entrer le nom"
                       style="color:#7DD3FC;"
                       class="w-full bg-[#1e293b] border border-sky-800 rounded-xl px-4 py-3 placeholder:text-sky-700 focus:ring-2 focus:ring-sky-400 focus:border-sky-400">
            </div>

            <div class="mb-6">
                <label class="block text-sky-300 mb-2">
                    Email
                </label>

                <input type="email"
                       name="email"
                       placeholder="email@example.com"
                       style="color:#7DD3FC;"
                       class="w-full bg-[#1e293b] border border-sky-800 rounded-xl px-4 py-3 placeholder:text-sky-700 focus:ring-2 focus:ring-sky-400 focus:border-sky-400">
            </div>

            <div class="mb-6">
                <label class="block text-sky-300 mb-2">
                    Téléphone
                </label>

                <input type="text"
                       name="telephone"
                       placeholder="+212..."
                       style="color:#7DD3FC;"
                       class="w-full bg-[#1e293b] border border-sky-800 rounded-xl px-4 py-3 placeholder:text-sky-700 focus:ring-2 focus:ring-sky-400 focus:border-sky-400">
            </div>

            <div class="mb-6">
                <label class="block text-sky-300 mb-2">
                    Adresse
                </label>

                <textarea
                    name="adresse"
                    rows="4"
                    placeholder="Adresse complète"
                    style="color:#7DD3FC;"
                    class="w-full bg-[#1e293b] border border-sky-800 rounded-xl px-4 py-3 placeholder:text-sky-700 focus:ring-2 focus:ring-sky-400 focus:border-sky-400"></textarea>
            </div>

            <div class="bg-sky-900/30 border border-sky-500/30 rounded-xl p-4 mb-6">
                <p class="text-sky-300">
                    Vérifiez les informations avant d'ajouter le fournisseur.
                </p>
            </div>

            <div class="flex gap-4">

                <button type="submit"
                        class="bg-sky-600 hover:bg-sky-500 text-white px-6 py-3 rounded-xl font-semibold transition">
                    Ajouter
                </button>

                <a href="{{ route('fournisseurs.index') }}"
                   class="bg-sky-950 hover:bg-sky-900 text-sky-300 border border-sky-800 px-6 py-3 rounded-xl transition">
                    Annuler
                </a>

            </div>

        </form>

    </div>

</div>

</x-app-layout>