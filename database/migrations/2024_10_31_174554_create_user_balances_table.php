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
        Schema::create('user_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->float('balance');
            $table->boolean('return_amount')->default(false);
            $table->string('model')->index()->nullable();
            $table->foreignId('flux_id')->nullable()->constrained();
            $table->foreignId('midjourney_id')->nullable()->constrained();
            $table->foreignId('removebg_id')->nullable()->constrained();
            $table->foreignId('runway_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_balances');
    }
};
