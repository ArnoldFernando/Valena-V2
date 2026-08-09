<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {

            // Remove old messaging columns
            if (Schema::hasColumn('messages', 'message_of')) {
                $table->dropForeign(['message_of']);
                $table->dropColumn('message_of');
            }

            if (Schema::hasColumn('messages', 'reply_message')) {
                $table->dropColumn('reply_message');
            }

            if (Schema::hasColumn('messages', 'reply_date')) {
                $table->dropColumn('reply_date');
            }

            if (Schema::hasColumn('messages', 'reply_is_read')) {
                $table->dropColumn('reply_is_read');
            }

            // Conversation
            if (!Schema::hasColumn('messages', 'conversation_id')) {
                $table->foreignId('conversation_id')
                    ->constrained(
                        'conversations',
                        'conversation_id'
                    )
                    ->cascadeOnDelete();
            }

            // Sender
            if (!Schema::hasColumn('messages', 'sender_id')) {
                $table->foreignId('sender_id')
                    ->constrained('users', 'id')
                    ->cascadeOnDelete();
            }

            // Message body
            if (
                Schema::hasColumn('messages', 'message') &&
                !Schema::hasColumn('messages', 'body')
            ) {
                $table->renameColumn('message', 'body');
            }

            // Read status
            if (!Schema::hasColumn('messages', 'read_at')) {
                $table->timestamp('read_at')->nullable();
            }

            // Remove old columns
            if (Schema::hasColumn('messages', 'message_date')) {
                $table->dropColumn('message_date');
            }

            if (Schema::hasColumn('messages', 'is_read')) {
                $table->dropColumn('is_read');
            }

            // Laravel timestamps
            if (!Schema::hasColumn('messages', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }

            if (!Schema::hasColumn('messages', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {

            if (Schema::hasColumn('messages', 'conversation_id')) {
                $table->dropForeign(['conversation_id']);
                $table->dropColumn('conversation_id');
            }

            if (Schema::hasColumn('messages', 'sender_id')) {
                $table->dropForeign(['sender_id']);
                $table->dropColumn('sender_id');
            }

            if (Schema::hasColumn('messages', 'read_at')) {
                $table->dropColumn('read_at');
            }

            if (Schema::hasColumn('messages', 'body')) {
                $table->renameColumn('body', 'message');
            }

            if (Schema::hasColumn('messages', 'created_at')) {
                $table->dropColumn('created_at');
            }

            if (Schema::hasColumn('messages', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
};
