<x-app-layout>

<div class="min-h-screen bg-[#0B1120] p-8">

    <div class="max-w-4xl mx-auto">

        <div class="bg-[#111827] rounded-2xl shadow-xl border border-slate-700 p-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white">
                    Envoyer une Invitation
                </h1>

                <p class="text-slate-400 mt-2">
                    Envoyer une nouvelle invitation à un fournisseur.
                </p>
            </div>
            @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            
        <form action="{{ route('invitations.store') }}" method="POST">
                @csrf
                 <div class="mb-6">
    <label class="block text-white mb-2">
        Fournisseur
    </label>

    <select name="fournisseur_id"
            class="w-full bg-[#1E293B] border border-slate-600 rounded-xl px-4 py-3 text-white">

        @foreach($fournisseurs as $fournisseur)

            <option value="{{ $fournisseur->id }}">
                {{ $fournisseur->name }}
            </option>

        @endforeach

    </select>
</div>
                <div class="mb-6">
                    <label class="block text-slate-300 mb-2 font-semibold">
                        Objet de l'invitation
                    </label>

                    <input type="text"
                           name="objet"
                           placeholder="Ex : Achat matériel informatique"
                           class="w-full bg-[#1E293B] border border-slate-600 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500">
                </div>

                <div class="mb-6">
                    <label class="block text-slate-300 mb-2 font-semibold">
                        Message
                    </label>

                    <textarea
                        name="message"
                        rows="5"
                        placeholder="Écrire un message..."
                        class="w-full bg-[#1E293B] border border-slate-600 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-cyan-500"></textarea>
                </div>

                <div class="flex justify-end gap-4">

                    <a href="{{ route('invitations.index') }}"
                       class="px-6 py-3 bg-slate-700 hover:bg-slate-600 text-white rounded-xl">
                        Annuler
                    </a>

                    <button type="submit"
                            class="px-6 py-3 bg-cyan-600 hover:bg-cyan-700 text-white rounded-xl font-semibold">
                        Envoyer l'invitation
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</x-app-layout>