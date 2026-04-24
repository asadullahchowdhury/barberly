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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id');
            $table->string('name');
            $table->text('description', 360)->nullable();
            $table->string('sessions')->default(1)->comment('1.Limited, 2.Unlimited');
            $table->string('session_no')->default(5)->nullable();
            $table->float('price');
            $table->string('valid_for');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('tax_rate')->nullable();
            $table->string('color')->nullable()->default('rgb(108, 213, 203)');
            $table->text('terms_conditions')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
