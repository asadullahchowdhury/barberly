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
        Schema::create('company_opening_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id');
            $table->tinyInteger('monday')->comment('Monday, 1.Active, 2.Inactive If Monday i 1 then others will be 2')->default(0);
            $table->tinyInteger('tuesday')->comment('Tuesday, 1.Active, 2.Inactive  If Tuesday i 1 then others will be 2')->default(0);
            $table->tinyInteger('wednesday')->comment('Wednesday, 1.Active, 2.Inactive  If Wednesday i 1 then others will be 2')->default(0);
            $table->tinyInteger('thursday')->comment('Thursday, 1.Active, 2.Inactive  If Thursday i 1 then others will be 2')->default(0);
            $table->tinyInteger('friday')->comment('Friday, 1.Active, 2.Inactive  If Friday i 1 then others will be 2')->default(0);
            $table->tinyInteger('saturday')->comment('Saturday, 1.Active, 2.Inactive  If Saturday i 1 then others will be 2')->default(0);
            $table->tinyInteger('sunday')->comment('Sunday, 1.Active, 2.Inactive  If Sunday i 1 then others will be 2')->default(0);
            $table->tinyInteger('status')->comment('1. Active, 2. Inactive')->default(1);
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_opening_hours');
    }
};
