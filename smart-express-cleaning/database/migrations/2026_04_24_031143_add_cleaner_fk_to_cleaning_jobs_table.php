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
        Schema::table('cleaning_jobs', function (Blueprint $table) {
            $table->foreign('cleaner_id')->references('id')->on('cleaners')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cleaning_jobs', function (Blueprint $table) {
            $table->dropForeign(['cleaner_id']);
        });
    }
};
