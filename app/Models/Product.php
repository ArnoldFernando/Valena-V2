<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'prod_id',
        'sup_id',
        'title',
        'slogan',
        'price',
        'img',
        'stocks',
        'total_ordered',
        'promo_status',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'sup_id', 'sup_id');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class, 'prod_id', 'prod_id');
    }
}
