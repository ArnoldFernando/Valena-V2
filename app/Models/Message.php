<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'message_id';
    public $timestamps = false;

    protected $fillable = ['message_of', 'message', 'message_date', 'is_read', 'reply_message', 'reply_date', 'reply_is_read'];

    protected $casts = [
        'message_date' => 'datetime',
        'reply_date' => 'datetime',
        'is_read' => 'boolean',
        'reply_is_read' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'message_of', 'id');
    }
}
