<x-app-layout>

<div class="min-h-screen bg-slate-950 text-white p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold">
                Ajouter un Appel d'Offre
            </h1>
            <p class="text-slate-400 text-sm">
                Créer un nouvel appel d'offre
            </p>
        </div>

        <a href="{{ route('appels_offres.index') }}"
           class="bg-slate-900 px-4 py-2 rounded-xl border border-slate-800 hover:bg-slate-800">
            Retour
        </a>
    </div>

    <!-- Formulaire -->
    <div class="max-w-4xl mx-auto">

        <div class="bg-slate-900 rounded-2xl border border-slate-800 p-8">

            <form action="{{ route('appels_offres.store') }}" method="POST">

                @csrf
                <form action="{{ route('appels_offres.store') }}" method="POST">
    @csrf

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Référence -->
    <div class="mb-5">
        ...

                <!-- Référence -->
                <div class="mb-5">
                    <label class="block mb-2 text-slate-300">
                        Référence
                    </label>

                    <input type="text"
                           name="reference"
                           class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">
                </div>

                <!-- Titre -->
                <div class="mb-5">
                    <label class="block mb-2 text-slate-300">
                        Titre
                    </label>

                    <input type="text"
                           name="titre"
                           class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <label class="block mb-2 text-slate-300">
                        Description
                    </label>

                    <textarea name="description"
                              rows="5"
                              class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white"></textarea>
                </div>

                <!-- Budget estimé -->
                <div class="mb-5">
                    <label class="block mb-2 text-slate-300">
                        Budget Estimé
                    </label>

                    <input type="number"
                           name="budget_estime"
                           step="0.01"
                           class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">
                </div>

                <!-- Statut -->
                <div class="mb-5">
                    <label class="block mb-2 text-slate-300">
                        Statut
                    </label>

                    <select name="statut"
                            class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">

                        <option value="Ouvert">Ouvert</option>
                        <option value="En cours">En cours</option>
                        <option value="Terminé">Terminé</option>

                    </select>
                </div>

                <!-- Date limite -->
                <div class="mb-8">
                    <label class="block mb-2 text-slate-300">
                        Date Limite
                    </label>

                    <input type="date"
                           name="date_limite"
                           class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">
                </div>

                <!-- Boutons -->
                <div class="flex gap-4">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl transition">
                        Enregistrer
                    </button>

                    <a href="{{ route('appels_offres.index') }}"
                       class="bg-slate-700 hover:bg-slate-600 px-6 py-3 rounded-xl transition">
                        Annuler
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>