<x-app-layout>

<div class="min-h-screen bg-[#0F172A] p-8">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">
            Modifier un Fournisseur
        </h1>

        <p class="text-sky-300 mt-2">
            Dashboard / Fournisseurs / Modifier
        </p>
    </div>

    <div class="max-w-4xl bg-[#111C2D] rounded-2xl border border-slate-700 shadow-xl p-8">

        <h2 class="text-2xl font-semibold text-sky-300 mb-6">
            Modifier les informations
        </h2>

        <form action="{{ route('fournisseurs.update', $fournisseur->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sky-300 mb-2">
                    Nom du fournisseur
                </label>

                <input type="text"
                       name="nom"
                       value="{{ $fournisseur->nom }}"
                       required
                       class="w-full bg-[#1E293B] border border-slate-600 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-sky-300 mb-2">
                    Email
                </label>

                <input type="email"
                       name="email"
                       value="{{ $fournisseur->email }}"
                       class="w-full bg-[#1E293B] border border-slate-600 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-sky-300 mb-2">
                    Téléphone
                </label>

                <input type="text"
                       name="telephone"
                       value="{{ $fournisseur->telephone }}"
                       class="w-full bg-[#1E293B] border border-slate-600 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-sky-300 mb-2">
                    Adresse
                </label>

                <textarea
                    name="adresse"
                    rows="4"
                    class="w-full bg-[#1E293B] border border-slate-600 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500">{{ $fournisseur->adresse }}</textarea>
            </div>

            <div class="bg-sky-900/20 border border-sky-700 rounded-xl p-4 mb-6">
                <p class="text-sky-300">
                    Vérifiez les informations avant d'enregistrer les modifications.
                </p>
            </div>

            <div class="flex gap-4">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                    Enregistrer
                </button>

                <a href="{{ route('fournisseurs.index') }}"
                   class="bg-slate-700 hover:bg-slate-600 text-white px-6 py-3 rounded-xl transition">
                    Annuler
                </a>

            </div>

        </form>

    </div>

</div>

</x-app-layout>