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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->string('title_mm')->nullable();
            $table->text('description');
            $table->text('description_mm')->nullable();
            $table->integer('duration');
            $table->json('exercise_steps');
            $table->json('exercise_steps_mm')->nullable();
            $table->string('tips')->nullable();
            $table->string('tips_mm')->nullable();
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
