<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionParticipant extends Model
{
    protected $fillable = [
    'commission_id',
    'user_id',
    'prenom',
    'nom',
    'fonction',
    'matricule',
];

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}