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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->bigInteger('mobile')->nullable();
            $table->tinyInteger('gender')->nullable()->comment('1.Male, 2.Female, 3.No-binary, 4.Prefer not to say');
            $table->date('dob')->nullable();
            $table->string('password');
            $table->bigInteger('otp')->nullable();
            $table->string('provider')->nullable()->default('system')->comment('1.system , 2.facebook , 3.google , 4.apple');
            $table->string('provider_id')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone')->nullable();
            $table->string('currency')->nullable();
            $table->string('language')->nullable();
            $table->string('reset_code')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->string('avatar')->nullable();
            $table->text('clients_info', 500)->nullable();
            $table->tinyInteger('display_booking')->default(2)->comment('1.True, 2.False');
            $table->bigInteger('additional_mobile')->nullable();
            $table->string('source')->nullable();
            $table->tinyInteger('initial_login')->nullable()->default(1)->comment('1.True, 2.False');
            $table->string('address_name')->nullable();
            $table->string('address')->nullable();
            $table->string('apartment')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('post_code')->nullable();
            $table->tinyInteger('email_notification')->default(2)->comment('1.True, 2.False');
            $table->tinyInteger('email_marketing_notification')->default(2)->comment('1.True, 2.False');
            $table->tinyInteger('text_message_notification')->default(2)->comment('1.True, 2.False');
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
        Schema::dropIfExists('customers');
    }
};
