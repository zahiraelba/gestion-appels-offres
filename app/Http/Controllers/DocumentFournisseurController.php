<?php

namespace App\Http\Controllers;

use App\Models\DocumentFournisseur;
use Illuminate\Http\Request;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentFournisseurController extends Controller
{
    // عرض صفحة الوثائق
    public function index()
{
    $fournisseur = Fournisseur::where('user_id', Auth::id())->first();
    if (!$fournisseur) {
        return redirect()->route('dashboard')
            ->with('error', 'Cette page est réservée aux fournisseurs.');
    }
    $documentsDb = DocumentFournisseur::where('fournisseur_id', $fournisseur->id)
    ->get()
    ->keyBy('type_document');
    $déposés = $documentsDb->count();
    $requis = 6;
    $manquants= $requis-$déposés;

    return view('fournisseurs.documents', compact(
        'documentsDb',
        'déposés',
        'requis',
        'manquants'
        ));
}

    // رفع وثيقة جديدة
    public function store(Request $request)
{
    $request->validate([
        'type_document' => 'required',
        'document' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
    ]);

    $fichier = $request->file('document');

    $chemin = $fichier->store('documents', 'public');
    $fournisseur = Fournisseur::where('user_id', Auth::id())->first();

DocumentFournisseur::create([
    'fournisseur_id' => $fournisseur->id,
    'type_document' => $request->type_document,
    'nom_fichier' => $fichier->getClientOriginalName(),
    'chemin_fichier' => $chemin,
    'statut' => 'En attente',
]);

return redirect()->route('documents.index')
    ->with('success', 'Document téléversé avec succès.');
   try {

    $document = DocumentFournisseur::create([
        'fournisseur_id' => $fournisseur->id,
        'type_document' => $request->type_document,
        'nom_fichier' => $fichier->getClientOriginalName(),
        'chemin_fichier' => $chemin,
        'statut' => 'En attente',
    ]);

    dd($document);

} catch (\Exception $e) {

    dd($e->getMessage());

}
    return redirect()->route('documents.index')
        ->with('success', 'Document téléversé avec succès.');
}

    // تحديث أو استبدال وثيقة
    public function update(Request $request, DocumentFournisseur $document)
    {
        //
    }

    // delete
    public function destroy(DocumentFournisseur $document)
    {
        //
    }
}