<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('income_from_capital_gains', function (Blueprint $table) {
            $table->id();

            // Relationship to submission
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');

            // Sale of Securities (Multiple documents possible)
            $table->json('demat_statements')->nullable();  // Multiple files

            // Sale of Immovable Property
            $table->json('sale_deeds')->nullable();        // Multiple files
            $table->json('purchase_deeds')->nullable();    // Multiple files
            $table->text('improvement_expense_details')->nullable(); // Text entry

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('income_from_capital_gains');
    }
};
