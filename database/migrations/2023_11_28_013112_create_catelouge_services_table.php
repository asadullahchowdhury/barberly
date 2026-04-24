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
        Schema::create('catelouge_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('company_user_id');
            $table->string('description',1000)->nullable();
            $table->string('sort')->default(0);
            $table->string('type')->nullable();
            $table->string('after_care',5000)->nullable();
            $table->tinyInteger('available_for')->default(3)->comment('1. Male, 2.Female, 3.Everyone');
            $table->string('team_commission')->nullable();
            $table->string('team_members')->nullable();
            $table->tinyInteger('online_booking')->default(1)->comment('1.True, 2.False');
            $table->string('extra_time')->nullable();
            $table->string('tax')->nullable();
            $table->string('pricing_id')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catelouge_services');
    }
};
