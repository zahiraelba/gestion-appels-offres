<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Offre extends Model
{
    use HasFactory;

    protected $table = 'offres';


    protected $fillable = [
        'titre', 
        'description', 
        'montant', 
        'fournisseur_id',// relie l'offre avec four
        'appel_offre_id'
    ];


    public function fournisseur()
    {
        return $this->belongsTo(User::class, 'fournisseur_id');
    }
    public function appeloffre()
    {
        return $this->belongsTo(AppelOffre::class);
    }
}