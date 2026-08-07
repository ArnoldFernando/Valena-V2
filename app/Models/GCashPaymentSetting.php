<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GCashPaymentSetting extends Model
{
    protected $table = 'gcash_payment_settings';

    protected $fillable = [
        'qr_image_path',
    ];
}
