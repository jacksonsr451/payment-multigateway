<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Gateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
        'priority',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('priority');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
