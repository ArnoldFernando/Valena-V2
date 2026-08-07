<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gcash_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->string('reference_number')->unique();
            $table->string('sender_name');
            $table->string('sender_number')->nullable();
            $table->decimal('paid_amount', 10, 2);
            $table->string('status')->default('pending');
            $table->text('admin_note')->nullable();
            $table->foreignId('received_by')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->timestamp('received_at')->nullable();
            $table->timestamps();
        });

        Schema::table('users_orders', function (Blueprint $table) {
            $table->foreignId('gcash_payment_id')->nullable()->after('user_id')->constrained('gcash_payments')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users_orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('gcash_payment_id');
        });

        Schema::dropIfExists('gcash_payments');
    }
};
