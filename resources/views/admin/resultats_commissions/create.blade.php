<x-app-layout>

<div class="min-h-screen bg-slate-950 text-white p-8">

    <div class="max-w-4xl mx-auto">


        <!-- Header -->
        <div class="mb-8">

            <h1 class="text-4xl font-bold">
                Enregistrer un résultat
            </h1>

            <p class="text-slate-400 mt-2">
                Ajouter la décision de la commission concernant un fournisseur.
            </p>

        </div>



        <!-- Form Card -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-8 shadow-xl">

            @if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-600 p-4 text-white">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="mb-4 rounded-lg bg-red-600 p-4 text-white">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="mb-4 rounded-lg bg-green-600 p-4 text-white">
        {{ session('success') }}
    </div>
@endif
            <form method="POST" action="{{ route('resultats-commissions.store') }}">

                @csrf



                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">



                    <!-- Commission -->

                    <div>

                        <label class="block text-sm text-slate-300 mb-2">
                            Commission
                        </label>


                        <select
                            id="commission"
                            name="commission_id"
                            class="w-full bg-slate-800 border border-slate-700 text-white rounded-xl p-3 focus:ring-blue-500">


                            <option value="">
                                Choisir une commission
                            </option>


                            @foreach($commissions as $commission)

                            <option value="{{ $commission->id }}">

                                Commission #{{ $commission->id }}

                                - {{ $commission->appelOffre->titre ?? '' }}

                            </option>

                            @endforeach


                        </select>


                    </div>




                    <!-- Fournisseur -->

                    <div>

                        <label class="block text-sm text-slate-300 mb-2">
                            Fournisseur
                        </label>


                        <select
                            id="fournisseur"
                            name="fournisseur_id"
                            class="w-full bg-slate-800 border border-slate-700 text-white rounded-xl p-3">


                            <option>
                                Choisir un fournisseur
                            </option>

                        </select>


                    </div>





                    <!-- Statut -->

                    <div>

                        <label class="block text-sm text-slate-300 mb-2">
                            Décision
                        </label>


                        <select
                            name="statut"
                            class="w-full bg-slate-800 border border-slate-700 text-white rounded-xl p-3">


                            <option value="">
                                Choisir un statut
                            </option>


                            <option value="Retenu">
                                Retenu
                            </option>


                            <option value="Non retenu">
                                Non retenu
                            </option>


                            <option value="Écarté">
                                Écarté
                            </option>


                        </select>

                    </div>


                </div>




                <!-- Observation -->

                <div class="mt-6">


                    <label class="block text-sm text-slate-300 mb-2">
                        Observation
                    </label>


                    <textarea
                        name="observation"
                        rows="5"
                        placeholder="Ajouter une observation..."
                        class="w-full bg-slate-800 border border-slate-700 text-white rounded-xl p-3">

                    </textarea>


                </div>





                <!-- Buttons -->

                <div class="flex justify-end gap-4 mt-8">


                    <a href="{{ route('resultats-commissions.index') }}"
                       class="px-6 py-3 rounded-xl bg-slate-700 hover:bg-slate-600 transition">

                        Annuler

                    </a>



                    <button
                        type="submit"
                        class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 transition font-semibold">


                        Enregistrer

                    </button>


                </div>



            </form>


        </div>



    </div>


</div>


<script>

document.getElementById('commission')
.addEventListener('change', function(){


let id=this.value;

let fournisseur=document.getElementById('fournisseur');


if(!id){

fournisseur.innerHTML=
'<option>Choisir une commission</option>';

return;

}


fournisseur.innerHTML=
'<option>Chargement...</option>';



fetch('/resultats-commissions/'+id+'/fournisseurs')


.then(response=>response.json())


.then(data=>{
   


fournisseur.innerHTML=
'<option value="">Choisir un fournisseur</option>';



data.forEach(item=>{


fournisseur.innerHTML +=

`
<option value="${item.id}">
${item.nom}
</option>
`;


});


});


});


</script>


</x-app-layout>