<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = ['news_number', 'name', 'intro_description', 'full_description', 'image', 'date'];

    protected $casts = [
        'date' => 'date',
    ];
}
