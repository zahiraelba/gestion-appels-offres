<?php

namespace App\Http\Controllers;

use App\Models\DocumentFournisseur;

class AdminDocumentController extends Controller
{
    public function index()
    {
        $documents = DocumentFournisseur::with('fournisseur')->latest()->get();

        return view('admin.documents.index', compact('documents'));
    }
    public function accepter(DocumentFournisseur $document)
{
    $document->update([
        'statut' => 'Accepté'
    ]);

    return back()->with('success', 'Document accepté.');
}
public function refuser(DocumentFournisseur $document)
{
    $document->update([
        'statut' => 'Refusé'
    ]);

    return back()->with('success', 'Document refusé.');
}
}
