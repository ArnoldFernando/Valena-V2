<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('adm_id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('code')->default('');
            $table->timestamp('date')->useCurrent();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('name');
            $table->string('f_name')->nullable()->after('username');
            $table->string('l_name')->nullable()->after('f_name');
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->boolean('status')->default(true)->after('address');
            $table->string('avatar')->nullable()->after('status');
            $table->boolean('is_admin')->default(false)->after('avatar');
        });

        Schema::create('supplier', function (Blueprint $table) {
            $table->id('sup_id');
            $table->string('title');
            $table->string('email');
            $table->string('phone');
            $table->string('url');
            $table->string('o_hr');
            $table->string('c_hr');
            $table->string('o_days');
            $table->text('address');
            $table->string('image')->nullable();
            $table->timestamp('date')->useCurrent();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('prod_id')->unique();
            $table->foreignId('sup_id')->constrained('supplier', 'sup_id');
            $table->string('title');
            $table->string('slogan');
            $table->decimal('price', 10, 2);
            $table->string('img')->nullable();
            $table->integer('stocks');
            $table->integer('total_ordered')->nullable();
            $table->string('promo_status')->default('No');
            $table->timestamps();
        });

        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->integer('fac_id')->unique();
            $table->string('name');
            $table->text('intro_description');
            $table->text('full_description');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('tourist_spots', function (Blueprint $table) {
            $table->id();
            $table->integer('ts_id')->unique();
            $table->string('name');
            $table->text('intro_description');
            $table->text('full_description');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->integer('news_number')->unique();
            $table->string('name');
            $table->text('intro_description');
            $table->longText('full_description');
            $table->string('image')->nullable();
            $table->date('date');
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id('message_id');
            $table->foreignId('message_of')->constrained('users', 'id');
            $table->text('message');
            $table->dateTime('message_date');
            $table->boolean('is_read')->default(false);
            $table->text('reply_message')->nullable();
            $table->timestamp('reply_date')->nullable();
            $table->boolean('reply_is_read')->default(false);
            $table->timestamp('read_at')->nullable();
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->integer('prod_id');
            $table->foreign('prod_id')->references('prod_id')->on('products');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->string('product_name');
            $table->double('price');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::create('users_orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->string('title');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->string('status')->nullable();
            $table->timestamp('date')->useCurrent();
            $table->decimal('trans_total', 10, 2);
            $table->string('proof_file')->nullable();
            $table->text('Message')->nullable();
        });

        Schema::create('remark', function (Blueprint $table) {
            $table->id();
            $table->integer('frm_id')->index();
            $table->string('status');
            $table->mediumText('remark');
            $table->mediumText('ratings');
            $table->timestamp('remarkDate')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('remark');
        Schema::dropIfExists('users_orders');
        Schema::dropIfExists('cart');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('products');
        Schema::dropIfExists('supplier');
        Schema::dropIfExists('news');
        Schema::dropIfExists('tourist_spots');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('admin');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'f_name', 'l_name', 'phone', 'address', 'status', 'avatar', 'is_admin']);
        });
    }
};
