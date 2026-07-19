<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppelOffre;
use App\Models\Offre;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    public function create($id)
    {

    $appel= AppelOffre::findOrFail($id);
    return view('offres.create' , compact('appel'));
    }
   public function store(Request $request)
{
    $request->validate([
        'titre' => 'required',
        'description' => 'required',
        'montant' => 'required|numeric',
        'appel_offre_id' => 'required',
    ]);

    Offre::create([
        'titre' => $request->titre,
        'description' => $request->description,
        'montant' => $request->montant,
        'fournisseur_id' => Auth::id(),
        'appel_offre_id' => $request->appel_offre_id,
    ]);

    return redirect()->route('mes.offres')
        ->with('success', 'Votre offre a été envoyée avec succès');
}
public function edit($id)
{
    $offre = Offre::findOrFail($id);
    return view('offres.modifier_offre', compact('offre'));
}

public function update(Request $request, $id)
{
    $offre = Offre::findOrFail($id);

    $offre->update([
        'titre' => $request->titre,
        'description' => $request->description,
        'montant' => $request->montant,
    ]);
       
    return redirect()->route('mes.offres');
}

public function destroy($id)
{
    Offre::findOrFail($id)->delete();

    return redirect()->route('mes.offres');
}
}
