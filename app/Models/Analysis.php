<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Analysis extends Model
{
    protected $fillable = [
        'user_id',
        'image_path',
        'image_public_id',
        'detected_ingredients',
    ];

    protected function casts(): array
    {
        return [
            'detected_ingredients' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
