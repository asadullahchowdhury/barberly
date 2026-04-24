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
        Schema::table('users', function (Blueprint $table) {
            $table->string('job_title')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('notes',1000)->nullable();
            $table->string('color')->nullable();
            $table->string('invitation_verified_at')->nullable();
            $table->string('status')->default(2)->comment('1.Pending, 2.Active, 3.Archived');
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('job_title');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('notes');
            $table->dropColumn('invitation_verified_at');
            $table->dropColumn('status');
            $table->dropColumn('deleted_at');
        });
    }
};
