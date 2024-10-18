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
            $table->text('user_prompt_ka')->nullable();
            $table->text('user_prompt_en')->nullable();
            $table->string('task_id')->nullable();
            $table->string('model')->nullable();
            $table->string('status')->nullable();
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
