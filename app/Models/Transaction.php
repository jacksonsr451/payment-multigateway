<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'PENDING';
    public const STATUS_APPROVED = 'APPROVED';
    public const STATUS_DECLINED = 'DECLINED';
    public const STATUS_FAILED = 'FAILED';

    protected $fillable = [
        'client_id',
        'gateway_id',
        'external_id',
        'status',
        'amount',
        'card_last_numbers',
    ];

    protected $casts = [
        'amount' => 'integer',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }

    public function transactionProducts(): HasMany
    {
        return $this->hasMany(TransactionProduct::class);
    }
}