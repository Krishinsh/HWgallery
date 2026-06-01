<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    protected $fillable = [
        'user_id',
        'model',
        'year',
        'series',
        'color',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }

    public function primaryImage(): ?CarImage
    {
        return $this->images->firstWhere('is_primary', true) ?? $this->images->first();
    }

    public function getImageUrlAttribute(): ?string
    {
        $bilde = $this->primaryImage();

        return $bilde?->url;
    }
}
