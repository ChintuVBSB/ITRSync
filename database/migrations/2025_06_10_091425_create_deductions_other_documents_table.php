<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deductions_other_documents', function (Blueprint $table) {
            $table->id();

            // Link to submission
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');

            // Uploads for other deduction types
            $table->json('other_deduction_documents')->nullable(); // EV Loan, Disability, NPS etc.

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deductions_other_documents');
    }
};
