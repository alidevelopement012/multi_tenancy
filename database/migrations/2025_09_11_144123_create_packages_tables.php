<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('term')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('recommended')->default(false);
            $table->string('icon')->nullable();
            $table->boolean('is_trial')->default(false);
            $table->integer('trial_days')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('storage_limit')->nullable();
            $table->integer('staff_limit')->nullable();
            $table->integer('order_limit')->nullable();
            $table->integer('categories_limit')->nullable();
            $table->integer('subcategories_limit')->nullable();
            $table->integer('items_limit')->nullable();
            $table->integer('table_reservation_limit')->nullable();
            $table->integer('language_limit')->nullable();
            $table->json('features')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
