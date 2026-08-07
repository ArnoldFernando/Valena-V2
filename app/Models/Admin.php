<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'adm_id';
    public $timestamps = false;

    protected $fillable = ['username', 'password', 'email', 'code'];
}
