<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        "stand_id",
        "details_commande",
        "date_commande",
    ];

    protected $casts = [
        "details_commande" => "array",
        "date_commande" => "datetime",
    ];

    public function stand()
    {
        return $this->belongsTo(Stand::class, "stand_id");
    }
}
