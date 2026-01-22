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
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('property_type_id');
            $table->unsignedBigInteger('contract_length_id')->nullable();
            $table->string('title');
            $table->string('city');
            $table->text('full_address');
            $table->decimal('price_amount', 10, 2);
            $table->enum('price_type', ['per_week', 'per_month']);
            $table->date('available_from')->nullable();
            $table->integer('bedroom_count')->default(0);
            $table->integer('bathroom_count')->default(0);
            $table->text('description')->nullable();
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('status', ['active', 'reject', 'pending'])->default('pending');
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
