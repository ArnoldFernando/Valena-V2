<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'sup_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'email',
        'phone',
        'url',
        'o_hr',
        'c_hr',
        'o_days',
        'address',
        'image',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'sup_id', 'sup_id');
    }
}
