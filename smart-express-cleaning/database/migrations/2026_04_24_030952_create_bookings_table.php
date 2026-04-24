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
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->enum('source', ['airbnb', 'pms', 'manual'])->default('manual');
            $table->string('external_booking_id')->nullable()->unique();
            $table->string('guest_name')->nullable();
            $table->unsignedTinyInteger('guest_count')->nullable();
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->enum('booking_status', ['confirmed', 'cancelled', 'completed'])->default('confirmed');
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();

            $table->index(['property_id', 'check_in', 'check_out']);
            $table->index(['booking_status', 'check_out']);
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
