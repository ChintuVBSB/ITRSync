<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deductions_80e', function (Blueprint $table) {
            $table->id();

            // Link to submission
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');

            // Uploads for education loan interest proof
            $table->json('education_loan_interest_proofs')->nullable(); // Bank statements or Interest Certificates

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deductions_80e');
    }
};
