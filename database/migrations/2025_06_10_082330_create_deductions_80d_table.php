<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deductions_80d', function (Blueprint $table) {
            $table->id();

            // Link to submission
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');

            // Multiple uploads for medical insurance receipts
            $table->json('mediclaim_receipts')->nullable(); // For self, spouse, children, parents

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deductions_80d');
    }
};
