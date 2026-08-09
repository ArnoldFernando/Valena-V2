<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $table = 'messages';

    protected $primaryKey = 'message_id';

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'body',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(
            Conversation::class,
            'conversation_id',
            'conversation_id'
        );
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'sender_id',
            'id'
        );
    }

    public function isFromAdmin(): bool
    {
        return $this->sender->is_admin ?? false;
    }

    public function markAsRead(): void
    {
        if ($this->read_at === null) {
            $this->update([
                'read_at' => now(),
            ]);
        }
    }
}
