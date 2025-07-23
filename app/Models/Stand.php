<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produit;
use App\Models\Commande;

class Stand extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_stand',
        'description',
        'user_id',
    ];

    // Un stand appartient à un utilisateur (entrepreneur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un stand a plusieurs produits
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    // Un stand a plusieurs commandes
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
