<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être remplis massivement.
     */
    protected $fillable = [
        'category_id',
        'question_text',
        'image_path',
        'points'
    ];

    /**
     * Récupérer la catégorie à laquelle appartient la question.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Récupérer les 4 réponses (A, B, C, D) associées à cette question.
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Méthode utilitaire pour obtenir directement la bonne réponse.
     */
    public function correctAnswer()
    {
        return $this->answers()->where('is_correct', true)->first();
    }
}