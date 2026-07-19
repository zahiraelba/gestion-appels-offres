<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Offre;
use App\Models\AppelOffre;
use App\Models\Invitation;
use App\Models\Fournisseur;


class FournisseurController extends Controller
{
    public function index(){
        // use App\Models\Fournisseur;
        $fournisseurs= \App\Models\Fournisseur::all();
        return view('admin.fournisseur-ajout.index',compact('fournisseurs'));
    }
    public function create(){
        $fournisseurs = Fournisseur::all();
        return view('admin.fournisseur-ajout.create', compact('fournisseurs'));
    }
    public function store(Request $request)
{
    $request->validate([
        'nom' => 'required',
        'email' => 'nullable|email',
        'telephone' => 'nullable',
        'adresse' => 'nullable',

        'rc' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
        'ice' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
        'if' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
        'cnss' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
        'attestation_fiscale' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
        'rib' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png',
    ]);

    $data = $request->only([
        'nom',
        'email',
        'telephone',
        'adresse'
    ]);

    foreach ([
        'rc',
        'ice',
        'if',
        'cnss',
        'attestation_fiscale',
        'rib'
    ] as $document) {

        if ($request->hasFile($document)) {
            $data[$document] = $request->file($document)
                ->store('documents', 'public');
        }
    }

    Fournisseur::create($data);

    return redirect()->route('fournisseurs.index')
        ->with('success', 'Fournisseur ajouté avec succès.');
}

  public function dashboard()
    {
        $totalOffres = Offre::count();
        $totalInvitations = Invitation::count();
        $totalAppels = AppelOffre::count();
        $totalEnCours = AppelOffre::where('statut','en_cours')->count();
        $totalAppelsOffres = AppelOffre::count();
        $derniersAppels = AppelOffre::latest()->take(5)->get();
        return view('fournisseurs.dashboard_fournisseur', compact(
            'totalOffres',
            'totalInvitations',
            'totalAppels',
            'totalAppelsOffres',
            'totalEnCours',
            'derniersAppels'
        ));
    }

    public function mesOffres()
    {
        $offres=Offre::all();
        return view('offres.mes-offres', compact('offres'));
    }

    public function invitations()
    {
        $invitations=Invitation::all();
        return view('fournisseurs.invitations', compact('invitations'));
    }

    public function appels()
    {
        $appels = AppelOffre::all();
        return view('fournisseurs.appels', compact('appels'));
    }
    public function edit(Fournisseur $fournisseur)
{
    return view('fournisseurs.edit', compact('fournisseur'));
}

public function destroy(Fournisseur $fournisseur)
{
    $fournisseur->delete();

    return redirect()->route('fournisseurs.index')
                     ->with('success', 'Fournisseur supprimé avec succès.');
}
public function update(Request $request, Fournisseur $fournisseur)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'telephone' => 'nullable|string|max:20',
        'adresse' => 'nullable|string',
    ]);

    $fournisseur->update([
        'nom' => $request->nom,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
    ]);

    return redirect()->route('fournisseurs.index')
                     ->with('success', 'Fournisseur modifié avec succès.');
}
}