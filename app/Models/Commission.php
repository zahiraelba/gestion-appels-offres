<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AppelOffre;
use App\Models\ResultatCommission;
class Commission extends Model
{
    protected $fillable = [

        'appel_offre_id',

        'date_commission',

        'heure',

        'lieu',

        'statut',

    ];

    public function appelOffre()
    {
        return $this->belongsTo(AppelOffre::class);
    }
    public function participants()
{
    return $this->hasMany(CommissionParticipant::class);
}
public function resultats()
{
    return $this->hasMany(ResultatCommission::class);
}
public function fournisseurs()
{
    return $this->appelOffre
        ->offres()
        ->with('fournisseur')
        ->get()
        ->pluck('fournisseur');
}
}