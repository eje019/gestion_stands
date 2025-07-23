<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stand;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'image_url',
        'stand_id',
    ];

    // Un produit appartient à un stand
    public function stand()
    {
        return $this->belongsTo(Stand::class);
    }
}
