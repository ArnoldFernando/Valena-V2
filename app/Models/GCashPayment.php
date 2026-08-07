<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GCashPayment extends Model
{
    protected $table = 'gcash_payments';

    protected $fillable = [
        'user_id',
        'reference_number',
        'sender_name',
        'sender_number',
        'paid_amount',
        'status',
        'admin_note',
        'received_by',
        'received_at',
    ];

    protected $casts = [
        'received_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'gcash_payment_id');
    }
}
