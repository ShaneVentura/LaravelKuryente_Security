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
        Schema::create('1hour_usage', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('meter_id')->constrained('meter')->cascadeOnDelete()->cascadeOnUpdate();

            $table->decimal('usage', 18, 10);
            $table->timestamp('recorded_at');
            $table->decimal('usagemark', 18, 10);
            $table->index('meter_id');
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('1hour_usage');
    }
};
