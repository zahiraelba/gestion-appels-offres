<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppelOffre extends Model
{
    protected $table = 'appel_offres'; 
    
    protected $fillable = [
        'reference',
        'titre',
        'description',
        'budget_estime',
        'statut',
        'date_limite'
     ];
     public function commission()
{
    return $this->hasOne(Commission::class);
}
    public function offres()
    {
        return $this->hasMany(Offre::class);
    }
}