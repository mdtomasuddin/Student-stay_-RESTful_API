<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Stripe\Entitlements\Feature;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade')->comment('category type=property');
            $table->string('location')->nullable();
            $table->string('full_address')->nullable();
            $table->decimal('price')->nullable();
            $table->string('duration_period')->nullable();
            $table->date('available_from')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->text('description')->nullable();
            $table->json('amenities')->nullable()->comment('category type=amenities');  //category type=amenities
            $table->json('bill_included')->nullable()->comment('category type=bill_included'); //category type=bill_included
            $table->boolean('is_feature')->default(false);
            $table->boolean('is_available')->default(false);
            $table->json('images')->nullable();
            $table->enum('status', ['approved', 'pending', 'rejected', 'cancelled', 'verified', 'active', 'inactive'])->default('pending');
            $table->timestamps();
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
