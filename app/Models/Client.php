<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'email',
        'telephone',
        'nom_entreprise',
        'immatriculation',
        'id_logiciel', 
        'actif',
        'nom_base_DS',
        'password',
        'token',
        'date_expiration_token',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * Hash du mot de passe avant la sauvegarde du modèle
     */
    public function save(array $options = [])
    {
        // Hash du mot de passe avant de sauvegarder le modèle
        if ($this->isDirty('password')) {
            $this->password = bcrypt($this->password);
        }

        parent::save($options);
    }

    /**
     * Vérifie si le token est valide (non expiré)
     */
    public function isTokenValid()
    {
        return $this->date_expiration_token && Carbon::now()->lessThanOrEqualTo($this->date_expiration_token);
    }

    /**
     * Définit la validité du token pour un certain nombre de jours
     */
    public function setTokenValidityDays(int $days)
    {
        $this->token = Str::random(60); 
        $this->date_expiration_token = Carbon::now()->addDays($days);
        $this->save();
    }

    /**
     * Vérifie si le client est en règle en fonction de toutes les factures
     * En règle si aucune facture impayée
     */
    public function isInGoodStanding()
    {
        return $this->factures()->where('montant', '>', 0)->count() === 0;
    }

    /**
     * Relation avec les factures
     */
    public function factures()
    {
        return $this->hasMany(Facture::class);
    }

    /**
     * Relation avec les logiciels via la table pivot client_logiciel
     */
    public function logiciels(): BelongsToMany
    {
        return $this->belongsToMany(Logiciel::class, 'client_logiciel', 'client_id', 'id_logiciel')->withTimestamps();
    }
}
