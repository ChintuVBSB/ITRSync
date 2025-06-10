<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('income_from_salaries', function (Blueprint $table) {
            $table->id();

            // Relationship to submission
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');

            // Uploads
            $table->json('form_16')->nullable();           // Multiple files
            $table->json('salary_slips')->nullable();       // Multiple files
            $table->json('arrear_sheets')->nullable();      // Multiple files

            // Pension case (no Form 16)
            $table->string('employer_pan')->nullable();
            $table->string('employer_address')->nullable();
            $table->decimal('salary_amount', 12, 2)->nullable();

            // HRA fields
            $table->decimal('hra_rent_paid', 12, 2)->nullable();
            $table->string('hra_city')->nullable();
            $table->string('hra_landlord_name')->nullable();
            $table->string('hra_property_address')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('income_from_salaries');
    }
};
