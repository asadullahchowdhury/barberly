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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('team_member_id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->dateTime('booking_date');
            $table->tinyInteger('status')->default(1)->comment('1.Pending, 2.Arrived, 3.Started, 4.No-show, 5.Cancel');
            $table->unsignedInteger('created_by')->comment('Users id');
            $table->tinyInteger('created_by_type')->comment('1.Owner, 2.Member , 3.Customer');
            $table->dateTime('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
