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
        Schema::create('correct_alternatives', function (Blueprint $table) {
            $table->id();
            $table->foreign('question_id')->constrained('questions');
            $table->foreign('alternative_id')->constrained('alternatives');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('correct_alternatives');
    }
};
