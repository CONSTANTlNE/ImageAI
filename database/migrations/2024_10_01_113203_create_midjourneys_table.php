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
        Schema::create('midjourneys', function (Blueprint $table) {
            $table->id();
            $table->string('user_prompt_ka')->nullable();
            $table->string('user_prompt_en')->nullable();
            $table->string('task_id')->nullable();
            $table->text('ai_revised_prompt')->nullable();
            $table->string('midjourney_url')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midjourneys');
    }
};
