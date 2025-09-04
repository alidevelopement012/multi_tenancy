<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('role_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('image')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('remember_token')->nullable();
            $table->integer('featured')->default(0);
            $table->integer('status')->default(0);
            $table->tinyInteger('online_status')->default(1)->comment('1 = Active ,0 = offline');
            $table->text('verification_link')->nullable();
            $table->tinyInteger('email_verified')->default(0)->comment('1 - verified, 0 - not verified');
            $table->tinyInteger('subdomain_status')->default(0)->comment('0 - pending, 1 - connected');
            $table->tinyInteger('preview_template')->default(0);
            $table->string('template_img', 100)->nullable();
            $table->integer('template_serial_number')->default(0);
            $table->text('pwa')->nullable();
            $table->timestamps();
            $table->text('pass_token')->nullable();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
