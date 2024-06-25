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
        Schema::create('daily_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stake_id')->constrained()->onDelete('cascade');
            $table->decimal('daily_return', 8, 2);
            $table->date('date');
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_returns');
    }
};
