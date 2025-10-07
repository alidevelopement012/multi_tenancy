<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('offline_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('short_description')->nullable();
            $table->longText('instructions')->nullable();
            $table->integer('serial_number')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_receipt')->default(false);
            $table->string('receipt')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offline_gateways');
    }
};

