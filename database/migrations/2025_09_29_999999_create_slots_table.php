<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id')->nullable(); // support multi-tenant
            $table->string('title')->nullable();
            $table->string('start_at'); // exact start
            $table->string('end_at');   // exact end
            $table->string('capacity')->default(1); // how many bookings allowed
            $table->string('buffer_minutes')->default(0); // buffer before/after in minutes
            $table->text('notes')->nullable();
            $table->string('active')->default('true');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slots');
    }
}
