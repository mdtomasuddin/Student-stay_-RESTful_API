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
        Schema::create('partner_requests', function (Blueprint $table) {
            $table->id();
            $table->string('registrar_full_name')->nullable();
            $table->string('letting_agent_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('property_count')->nullable();
            $table->string('city')->nullable();
            $table->date('contact_date')->nullable();
            $table->time('contact_time')->nullable();
            $table->string('heard_about_us')->nullable();
            $table->enum('status', ['active', 'reject', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_requests');
    }
};
