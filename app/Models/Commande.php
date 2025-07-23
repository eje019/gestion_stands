<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stand;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'stand_id',
        'details_commande',
        'date_commande',
    ];

    // Une commande appartient à un stand
    public function stand()
    {
        return $this->belongsTo(Stand::class);
    }
}
