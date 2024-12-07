<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Logiciel extends Model
{
    use HasFactory;

    // Table et clé primaire personnalisées
    protected $table = 'logiciel';
    protected $primaryKey = 'id_logiciel';
    public $incrementing = true;
    protected $keyType = 'int';

    // Champs qui peuvent être remplis par l'utilisateur
    protected $fillable = [
        'nom_logiciel',
        'date_debut',
        'date_fin',
    ];

    // Relation many-to-many avec les clients
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_logiciel', 'id_logiciel', 'client_id');
    }
}
