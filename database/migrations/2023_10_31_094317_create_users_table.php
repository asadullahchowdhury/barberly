<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password');
            $table->bigInteger('mobile')->nullable();
            $table->bigInteger('otp')->nullable();
            $table->tinyInteger('user_type')->default(1)->comment('1. Owner, 2. Employee');
            $table->string('provider')->nullable()->default('system')->comment('1. system , 2. facebook , 3. google , 4. apple');
            $table->string('provider_id')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone')->nullable();
            $table->string('currency')->nullable();
            $table->string('language')->nullable();
            $table->string('reset_code')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email_verified_at')->nullable();
            $table->string('verified_token')->nullable();
            $table->rememberToken();
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
