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
        Schema::create('cleaning_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('cleaner_id')->nullable();
            $table->dateTime('scheduled_start');
            $table->dateTime('scheduled_end')->nullable();
            $table->enum('status', ['pending', 'assigned', 'in_progress', 'completed', 'missed', 'cancelled'])->default('pending');
            $table->unsignedTinyInteger('priority')->default(3);
            $table->boolean('manual_override')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['property_id', 'scheduled_start']);
            $table->index(['cleaner_id', 'status']);
            $table->index(['status', 'scheduled_start']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cleaning_jobs');
    }
};
