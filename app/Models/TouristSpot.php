<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TouristSpot extends Model
{
    protected $table = 'tourist_spots';

    protected $fillable = ['ts_id', 'name', 'intro_description', 'full_description', 'image'];
}
