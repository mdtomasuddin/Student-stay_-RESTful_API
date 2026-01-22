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
        Schema::create('c_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('page')->nullable();
            $table->string('section')->nullable();
            $table->text('title')->nullable();
            $table->text('sub_title')->nullable();
            $table->text('description')->nullable();
            $table->text('sub_description')->nullable();
            $table->string('image')->nullable();
            $table->json('sub_image')->nullable();
            $table->string('button')->nullable();
            $table->string('sub_button')->nullable();            
            $table->json('tag')->nullable();
            $table->json('cards')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_m_s');
    }
};
