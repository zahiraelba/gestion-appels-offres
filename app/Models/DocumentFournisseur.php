<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentFournisseur extends Model
{
    protected $fillable = [
        'fournisseur_id',
        'type_document',
        'nom_fichier',
        'chemin_fichier',
        'statut',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
