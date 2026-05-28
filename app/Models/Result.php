<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être remplis massivement.
     * Note : 'category_id' est essentiel pour lier le score à une compétition.
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'score',
        'played_at'
    ];

    /**
     * Les attributs qui doivent être castés dans des types natifs.
     */
    protected $casts = [
        'played_at' => 'datetime',
        'score' => 'integer',
    ];

    /**
     * Relation : Récupérer l'utilisateur qui possède ce résultat.
     * Utilisé pour afficher le nom du joueur dans le classement.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : Récupérer la catégorie associée à ce résultat.
     * Utilisé pour savoir sur quel thème le score a été réalisé.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}