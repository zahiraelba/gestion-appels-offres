<x-app-layout>

<div class="min-h-screen bg-slate-950 text-white p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold">
                Modifier un Appel d'Offre
            </h1>
            <p class="text-slate-400 text-sm">
                Modifier les informations de l'appel d'offre
            </p>
        </div>

        <a href="{{ route('appels_offres.index') }}"
           class="bg-slate-900 px-4 py-2 rounded-xl border border-slate-800 hover:bg-slate-800">
            Retour
        </a>
    </div>

    <!-- Formulaire -->
    <div class="max-w-4xl mx-auto">

        <div class="bg-slate-900 rounded-2xl p-8 border border-slate-800">

            <form action="{{ route('appels_offres.update', $appel->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <!-- Référence -->
                <div class="mb-5">
                    <label class="block mb-2 text-slate-300">
                        Référence
                    </label>

                    <input type="text"
                           name="reference"
                           value="{{ $appel->reference }}"
                           class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">
                </div>

                <!-- Titre -->
                <div class="mb-5">
                    <label class="block mb-2 text-slate-300">
                        Titre
                    </label>

                    <input type="text"
                           name="titre"
                           value="{{ $appel->titre }}"
                           class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">
                </div>

                <!-- Description -->
                <div class="mb-5">
                    <label class="block mb-2 text-slate-300">
                        Description
                    </label>

                    <textarea name="description"
                              rows="5"
                              class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">{{ $appel->description }}</textarea>
                </div>

                <!-- Budget -->
                <div class="mb-5">
                    <label class="block mb-2 text-slate-300">
                        Budget estimé
                    </label>

                    <input type="number"
                           name="budget_estime"
                           value="{{ $appel->budget_estime }}"
                           class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">
                </div>

                <!-- Statut -->
                <div class="mb-5">
                    <label class="block mb-2 text-slate-300">
                        Statut
                    </label>

                    <select name="statut"
                            class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">

                        <option value="Ouvert" {{ $appel->statut == 'Ouvert' ? 'selected' : '' }}>
                            Ouvert
                        </option>

                        <option value="En cours" {{ $appel->statut == 'En cours' ? 'selected' : '' }}>
                            En cours
                        </option>

                        <option value="Terminé" {{ $appel->statut == 'Terminé' ? 'selected' : '' }}>
                            Terminé
                        </option>

                    </select>
                </div>

                <!-- Date limite -->
                <div class="mb-8">
                    <label class="block mb-2 text-slate-300">
                        Date limite
                    </label>

                    <input type="date"
                           name="date_limite"
                           value="{{ $appel->date_limite }}"
                           class="w-full bg-slate-800 border border-slate-700 rounded-xl p-3 text-white">
                </div>

                <!-- Boutons -->
                <div class="flex gap-4">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl">
                        Modifier
                    </button>

                    <a href="{{ route('appels_offres.index') }}"
                       class="bg-slate-700 hover:bg-slate-600 px-6 py-3 rounded-xl">
                        Annuler
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>