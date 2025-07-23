<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_stand',
        'description',
        'utilisateur_id',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function produits()
    {
        return $this->hasMany(Produit::class, 'stand_id');
    }
}
