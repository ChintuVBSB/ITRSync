<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deductions_donations', function (Blueprint $table) {
            $table->id();

            // Link to submission
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');

            // Donation Receipts (charity, political, research)
            $table->json('donation_receipts')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deductions_donations');
    }
};
