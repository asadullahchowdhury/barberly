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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id');
            $table->string('type')->default('promotion')->comment('promotion, flash_sale, last_minute');
            $table->string('name');
            $table->text('description',600)->nullable();
            $table->tinyInteger('gift_card')->default(2)->comment('1. Active, 2. Inactive');
            $table->date('start_date');
            $table->date('end_date')->nullable()->comment('if null then never expire');
            $table->string('promotion_value')->nullable();
            $table->string('promotion_type')->nullable()->default('%')->comment('% or user currency');
            $table->tinyInteger('check_limit_per_client')->default(1);
            $table->integer('limit_uses')->default(1);
            $table->tinyInteger('set_minimum_amount')->default(2)->comment('1. Active, 2. Inactive');
            $table->integer('minimum_amount')->default(100);
            $table->tinyInteger('enable_point_of_sale')->default(1)->comment('1.Active, 2.Inactive');
            $table->tinyInteger('enable_discount')->default(2)->comment('1.Active, 2.Inactive');
            $table->tinyInteger('status')->default(1)->comment('1.Active, 2.Inactive, 3.Archive');
            $table->string('discount_code')->nullable();
            $table->string('appointment_time')->nullable()->default(1)->comment('Default time will be 1.');
            $table->string('appointment_type')->nullable()->default(2)->comment('1.Days, 2.Hours, 3.Minutes');
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};
