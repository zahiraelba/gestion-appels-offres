<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultatCommission extends Model
{
    protected $fillable = [
    'commission_id',
    'fournisseur_id',
    'statut',
    'observation',
];
public function commission()
{
    return $this->belongsTo(Commission::class);
}

public function fournisseur()
{
    return $this->belongsTo(Fournisseur::class);
}
}
