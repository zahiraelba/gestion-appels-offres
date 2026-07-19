<?php

namespace App\Http\Controllers;

use App\Models\AppelOffre;
use Illuminate\Http\Request;

class AppelOffreController extends Controller
{
    public function index()
    {
        
        $appels = AppelOffre::all();
        
        // rtr pg appels offres
        return view('appels_offres.index', compact('appels'));
    }
    public function create()
    {
        return view('appels_offres.create');
    }
    public function store(Request $request)
{
    $request->validate([
        'reference' => 'required',
        'titre' => 'required',
        'description' => 'required',
        'budget_estime' => 'required|numeric',
        'statut' => 'required',
        'date_limite' => 'required|date',
    ]);
        
    AppelOffre::create([
        'reference' => $request->reference,
        'titre' => $request->titre,
        'description' => $request->description,
        'budget_estime' => $request->budget_estime,
        'statut' => $request->statut,
        'date_limite' => $request->date_limite,
    ]);

    return redirect()
            ->route('appels_offres.index')
            ->with('success', 'Appel d\'offre ajouté avec succès');
}
// Affichage formulaire modification
public function edit($id)
{
    $appel = AppelOffre::findOrFail($id);

    return view('appels_offres.edit', compact('appel'));
}

// edit ao
public function update(Request $request, $id)
{
    $request->validate([
        'reference' => 'required',
        'titre' => 'required',
        'description' => 'required',
        'budget_estime' => 'required|numeric',
        'statut' => 'required',
        'date_limite' => 'required|date',
    ]);

    $appel = AppelOffre::findOrFail($id);

    $appel->update([
        'reference' => $request->reference,
        'titre' => $request->titre,
        'description' => $request->description,
        'budget_estime' => $request->budget_estime,
        'statut' => $request->statut,
        'date_limite' => $request->date_limite,
    ]);

    return redirect()
            ->route('appels_offres.index')
            ->with('success', 'Appel d\'offre modifié avec succès');
}

// Supprimer un ao
public function destroy($id)
{
    $appel = AppelOffre::findOrFail($id);

    $appel->delete();

    return redirect()
            ->route('appels_offres.index')
            ->with('success', 'Appel d\'offre supprimé avec succès');
}
}