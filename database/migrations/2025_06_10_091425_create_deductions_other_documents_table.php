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
            $table->foreignId('submission_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Store an array of uploads: path + description + timestamp
            $table->json('other_deduction_documents')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deductions_other_documents');
    }
};
