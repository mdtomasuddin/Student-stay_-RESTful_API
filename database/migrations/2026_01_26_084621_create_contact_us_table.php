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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('place_of_study_id')->constrained('categories')->nullable();
            $table->string('budget')->nullable();
            $table->date('preferred_move_in_date')->nullable();
            $table->foreignId('room_type_id')->constrained('categories')->nullable();
            $table->text('other_preferences')->nullable();
            $table->foreignId('referral_source_id')->constrained('categories')->nullable();
            $table->enum('status', ['new', 'contacted', 'in_progress', 'closed'])->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};
