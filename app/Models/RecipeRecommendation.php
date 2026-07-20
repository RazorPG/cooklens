<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecipeRecommendation extends Model
{
    protected $fillable = [
        'analysis_id',
        'recipe_name',
        'match_percentage',
        'cooking_time',
        'difficulty',
        'reason',
        'recipe_data',
    ];

    protected function casts(): array
    {
        return [
            'match_percentage' => 'integer',
            'cooking_time' => 'integer',
            'recipe_data' => 'array',
        ];
    }

    public function analysis(): BelongsTo
    {
        return $this->belongsTo(Analysis::class);
    }
}
