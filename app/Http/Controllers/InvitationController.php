<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\User;

class InvitationController extends Controller
{
    // Afficher la liste des invitations + formulaire

    public function index()
    {
        $fournisseurs = User::where('role', 'fournisseur')->get();

        $invitations = Invitation::all();

        return view(
            'admin.invitations.index',
            compact('fournisseurs', 'invitations')
        );
    }
    public function create()
{
    $fournisseurs = User::where('role', 'fournisseur')->get();

    return view('invitations.create', compact('fournisseurs'));
}
    // Enregistrer une nouvelle invitation

    public function store(Request $request)
    {
        $request->validate([
            'fournisseur_id' => 'required',
            'objet' => 'required',
            'message' => 'required',
        ]);

        Invitation::create([
            'fournisseur_id' => $request->fournisseur_id,
            'objet' => $request->objet,
            'message' => $request->message,
            'statut' => 'En attente',
        ]);

        return redirect()
            ->route('invitations.index')
            ->with(
                'success',
                'Invitation envoyée avec succès'
            );
    }
    public function accepter($id)
{
    $invitation = Invitation::findOrFail($id);
    $invitation->update(['statut' => 'Acceptée']);

    return redirect()->route('mes.invitations')
        ->with('success', 'Invitation acceptée avec succès');
}

public function refuser($id)
{
    $invitation = Invitation::findOrFail($id);
    $invitation->update(['statut' => 'Refusée']);

    return redirect()->route('mes.invitations')
        ->with('success', 'Invitation refusée');
}
}