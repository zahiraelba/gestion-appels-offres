<?php

namespace App\Http\Controllers;

use App\Models\ResultatCommission;
use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\Fournisseur;
class ResultatCommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $resultats = ResultatCommission::with(['commission.appelOffre', 'fournisseur'])->get();

    $totalResultats = $resultats->count();
    $retenus = $resultats->where('statut', 'Retenu')->count();
    $nonRetenus = $resultats->where('statut', 'Non retenu')->count();
    $ecartes = $resultats->where('statut', 'Écarté')->count();

    return view('admin.resultats_commissions.index', compact(
        'resultats',
        'totalResultats',
        'retenus',
        'nonRetenus',
        'ecartes'
    ));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $commissions = Commission::with('appelOffre')->get();
    

    return view('admin.resultats_commissions.create', compact('commissions'));
}
    /**
     * Store a newly created resource in storage.
     */
   public function getFournisseurs($id)
{
    $commission = Commission::with('appelOffre.offres.fournisseur')
        ->findOrFail($id);

    $fournisseurs = $commission->appelOffre
        ->offres
        ->map(function ($offre) {
            return \App\Models\Fournisseur::where('user_id', $offre->fournisseur_id)->first();
        })
        ->filter()
        ->values();

    return response()->json($fournisseurs);
}
 

public function store(Request $request)
{
    $request->validate([
        'commission_id' => 'required|exists:commissions,id',
        'fournisseur_id' => 'required|exists:fournisseurs,id',
        'statut' => 'required|in:Retenu,Non retenu,Écarté',
        'observation' => 'nullable|string',
    ]);

    $fournisseur = Fournisseur::findOrFail($request->fournisseur_id);

    ResultatCommission::create([
        'commission_id' => $request->commission_id,
        'fournisseur_id' => $fournisseur->id,
        'statut' => $request->statut,
        'observation' => $request->observation,
    ]);

    return redirect()
        ->route('resultats-commissions.index')
        ->with('success', 'Résultat enregistré avec succès.');
}
    /**
     * Display the specified resource.
     */
    public function show(ResultatCommission $resultatCommission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
{
    $resultatCommission = ResultatCommission::findOrFail($id);

    $commissions = Commission::with('appelOffre')->get();

    return view('admin.resultats_commissions.edit', compact(
        'resultatCommission',
        'commissions'
    ));
}
    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $resultatCommission)
{
    $resultatCommission = ResultatCommission::findOrFail($resultatCommission);

    $request->validate([
        'commission_id' => 'required|exists:commissions,id',
        'fournisseur_id' => 'required|exists:fournisseurs,id',
        'statut' => 'required|in:Retenu,Non retenu,Écarté',
        'observation' => 'nullable|string',
    ]);

    $resultatCommission->update([
        'commission_id' => $request->commission_id,
        'fournisseur_id' => $request->fournisseur_id,
        'statut' => $request->statut,
        'observation' => $request->observation,
    ]);

    return redirect()->route('resultats-commissions.index')
        ->with('success', 'Résultat modifié avec succès.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
     $resultatCommission = ResultatCommission::findOrFail($id);
    $resultatCommission->delete();

    return redirect()->route('resultats-commissions.index')
        ->with('success', 'Résultat supprimé avec succès.');
}

}
