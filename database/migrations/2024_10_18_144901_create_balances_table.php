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
        Schema::create('balances', function (Blueprint $table) {
            $table->id();
            $table->float('balance')->nullable();
            $table->float('rate')->nullable();
            $table->string('provider')->nullable();
            $table->string('model')->nullable();
            $table->float('cost')->nullable();
            $table->float('cost_gel')->nullable();
            $table->float('sell')->nullable();
            $table->float('profit')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balances');
    }
};
