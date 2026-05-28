<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être remplis massivement.
     */
    protected $fillable = [
        'question_id',
        'answer_text',
        'is_correct'
    ];

    /**
     * Indique si les attributs doivent être castés.
     * On s'assure que is_correct soit toujours traité comme un vrai booléen (true/false).
     */
    protected $casts = [
        'is_correct' => 'boolean',
    ];

    /**
     * Récupérer la question à laquelle cette réponse appartient.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}