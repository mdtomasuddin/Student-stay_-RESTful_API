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
        Schema::create('room_listings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->json('room_type')->nullable()->comment('category type=room_type');
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->json('amenities')->nullable()->comment('category type=amenities'); //category type=amenities
            $table->string('contract_type')->nullable()->comment('rental, sale');
            $table->date('move_in_date')->nullable();
            $table->date('move_out_date')->nullable();
            $table->integer('tenancy_weeks_min')->nullable();
            $table->integer('tenancy_weeks_max')->nullable();
            $table->decimal('price_per_week', 8, 2)->nullable();
            $table->decimal('min_price', 10, 2)->nullable();
            $table->decimal('max_price', 10, 2)->nullable();
            $table->boolean('is_single_occupancy')->default(false);
            $table->boolean('is_available')->default(false);
            $table->boolean('is_feature')->default(false);
            $table->enum('status', ['available', 'occupied', 'maintenance', 'reserved'])->default('available');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_listings');
    }
};
