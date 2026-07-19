<x-app-layout>

<div class="min-h-screen bg-[#0B1120] py-8">

    <div class="max-w-7xl mx-auto px-6">

        <!-- Titre -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white">
                 Mes Documents
            </h1>
            <p class="text-slate-400 mt-2">
                Gérez tous vos documents administratifs.
            </p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-[#1E293B] rounded-2xl p-6 border border-slate-700">
                <p class="text-slate-400">Documents requis</p>
                <h2 class="text-3xl font-bold text-white mt-2">{{$requis}}</h2>
            </div>

            <div class="bg-[#1E293B] rounded-2xl p-6 border border-slate-700">
                <p class="text-slate-400">Déposés</p>
                <h2 class="text-3xl font-bold text-green-400 mt-2">{{$déposés}}</h2>
            </div>

            <div class="bg-[#1E293B] rounded-2xl p-6 border border-slate-700">
                <p class="text-slate-400">Manquants</p>
                <h2 class="text-3xl font-bold text-red-400 mt-2">{{$manquants}}</h2>
            </div>

        </div>

        @php
        $documents = [
            ['code'=>'RC','nom'=>'Registre de Commerce'],
            ['code'=>'ICE','nom'=>'ICE'],
            ['code'=>'IF','nom'=>'Identifiant Fiscal'],
            ['code'=>'CNSS','nom'=>'Attestation CNSS'],
            ['code'=>'ATTESTATION_FISCALE','nom'=>'Attestation Fiscale'],
            ['code'=>'RIB','nom'=>'RIB Bancaire'],
        ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach($documents as $doc)

            <div class="bg-[#1E293B] border border-slate-700 rounded-2xl p-6 shadow-lg">

                <div class="flex justify-between items-center">

                    <div>
                        <h2 class="text-white font-bold text-lg">
                            {{ $doc['nom'] }}
                        </h2>

                        @if(isset($documentsDb[$doc['code']]))
    <p class="text-sm text-green-400 mt-1">
        ● Déposé
    </p>
@else
    <p class="text-sm text-red-400 mt-1">
        ● Manquant
    </p>
@endif
                    </div>

                </div>

                <form class="mt-5"
                      method="POST"
                      action="{{ route('documents.store') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <input type="hidden"
                           name="type_document"
                           value="{{ $doc['code'] }}">

                    <input type="file"
                           name="document"
                           class="block w-full text-sm text-slate-300
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-lg
                           file:border-0
                           file:bg-sky-600
                           file:text-white
                           hover:file:bg-sky-700">

                    <button
                        class="w-full mt-5 bg-sky-600 hover:bg-sky-700 text-white py-2 rounded-xl font-semibold transition">

                         Téléverser

                    </button>

                </form>

                <div class="grid grid-cols-3 gap-2 mt-5">

                    <button disabled
                        class="bg-slate-700 text-slate-400 rounded-lg py-2">
                         Voir
                    </button>

                    <button disabled
                        class="bg-slate-700 text-slate-400 rounded-lg py-2">
                         Télécharger
                    </button>

                    <button disabled
                        class="bg-slate-700 text-slate-400 rounded-lg py-2">
                         Remplacer
                    </button>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>

</x-app-layout>