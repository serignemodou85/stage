<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'numero',
        'date',
        'montant',
        'regle',
        'date_limite',

    ];

    // Relation inverse : Une facture appartient à un client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
