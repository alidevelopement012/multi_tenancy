<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->decimal('package_price', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->string('coupon_code')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('currency', 10)->nullable();
            $table->string('currency_symbol', 10)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['pending', 'active', 'expired', 'cancelled'])->default('pending');
            $table->boolean('is_trial')->default(false);
            $table->integer('trial_days')->nullable();
            $table->string('receipt')->nullable();
            $table->json('transaction_details')->nullable();
            $table->json('settings')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('expire_date')->nullable();
            $table->string('conversation_id')->nullable();
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('packages')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
