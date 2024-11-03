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
        Schema::create('fluxes', function (Blueprint $table) {
            $table->id();
            $table->text('prompt_en')->nullable();
            $table->text('prompt_ka')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('public')->default(false);
            $table->string('image_url')->nullable();
            $table->string('model')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fluxes');
    }
};
