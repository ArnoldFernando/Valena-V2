<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $table = 'users_orders';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = ['user_id', 'title', 'quantity', 'price', 'status', 'date', 'trans_total', 'proof_file', 'Message'];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
