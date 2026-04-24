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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('host_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('location');
            $table->enum('property_type', ['apartment', 'house', 'villa', 'studio', 'other'])->default('apartment');
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->unsignedInteger('square_feet')->nullable();
            $table->enum('listing_platform', ['airbnb', 'pms', 'manual'])->default('manual');
            $table->string('external_listing_id')->nullable();
            $table->unsignedSmallInteger('default_cleaning_minutes')->default(120);
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['host_user_id', 'is_active']);
            $table->index(['listing_platform', 'external_listing_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
