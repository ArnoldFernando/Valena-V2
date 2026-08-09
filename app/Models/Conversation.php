<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    protected $table = 'conversations';

    protected $primaryKey = 'conversation_id';

    protected $fillable = [
        'user_id',
        'subject',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }

    public function messages(): HasMany
    {
        return $this->hasMany(
            Message::class,
            'conversation_id',
            'conversation_id'
        )->orderBy('created_at');
    }

    public function latestMessage()
    {
        return $this->hasOne(
            Message::class,
            'conversation_id',
            'conversation_id'
        )->latest('created_at');
    }
}
