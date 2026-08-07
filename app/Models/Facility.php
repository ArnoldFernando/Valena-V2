<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';

    protected $fillable = ['fac_id', 'name', 'intro_description', 'full_description', 'image'];
}
