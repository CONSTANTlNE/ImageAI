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
        Schema::create('runways', function (Blueprint $table) {
            $table->id();
            $table->string('task_id')->index()->nullable();
            $table->text('prompt_en')->nullable();
            $table->text('prompt_ka')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('video_url')->nullable();
            $table->string('error')->nullable();
            $table->string('status')->nullable();
            $table->integer('duration')->default(5);
            $table->string('ratio')->default('16:9');
            $table->string('provider')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('runways');
    }
};
