<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deductions_80c', function (Blueprint $table) {
            $table->id();

            // Link to main submission
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');

            // Multiple uploads for each 80C proof
            $table->json('life_insurance_receipts')->nullable();       // Premium payment receipts
            $table->json('ppf_statements')->nullable();                 // PPF account
            $table->json('epf_statements')->nullable();                 // EPF account
            $table->json('mutual_fund_fds')->nullable();                // Tax Saver Mutual Funds / FDs
            $table->json('tuition_fee_receipts')->nullable();          // Spouse/Children tuition fee
            $table->json('other_investment_proofs')->nullable();       // SCSS, Sukanya scheme, etc.

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deductions_80c');
    }
};
