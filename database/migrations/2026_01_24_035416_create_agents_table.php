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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('letting_agent_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('source')->comment('How did you hear about us');
            $table->string('properties_managed_count');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->text('notes')->nullable();
            $table->string('ip_address')->nullable();
            $table->enum('status', ['approved', 'pending', 'rejected', 'cancelled', 'verified'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
