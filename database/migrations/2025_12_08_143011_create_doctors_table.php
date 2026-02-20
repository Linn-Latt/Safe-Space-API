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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('name', 150);
            $table->enum('medical_degree', ['MBBS', 'MD', 'DO', 'M.Med.Sc', 'Other']);
            $table->foreignId('medical_school_id')->constrained('medical_schools');
            $table->year('graduation_year');
            $table->enum('specialization', ['general_medicine', 'psychiatry']);
            $table->string('license_number', 30)->unique();
            $table->date('license_expiry_date');
            $table->string('license_authority', 150)->default('Myanmar Medical Council');
            $table->tinyInteger('years_of_experience')->unsigned();
            $table->boolean('is_currently_practicing')->default(true);
            $table->string('practice_city', 100);
            $table->string('practice_state', 100);
            $table->string('clinic_name', 150)->nullable();
            $table->string('clinic_registration_number', 50)->nullable();
            $table->json('professional_memberships')->nullable();
            $table->boolean('credentials_confirmed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
