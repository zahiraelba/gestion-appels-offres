<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'fournisseur_id',
        'objet',
        'message',
        'statut',
    ];
}
