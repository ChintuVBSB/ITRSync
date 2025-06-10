<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('income_from_other_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');

            $table->string('interest_certificate')->nullable(); // 1. Upload
            $table->string('dividend_company')->nullable();     // 2. Data Entry
            $table->decimal('dividend_amount', 12, 2)->nullable();

            $table->string('other_party_name')->nullable();     // 3. Data Entry
            $table->decimal('other_party_amount', 12, 2)->nullable();

            $table->string('crypto_statement')->nullable();     // 4. Upload

            $table->string('other_description')->nullable();    // 5. Data Entry
            $table->decimal('other_amount', 12, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('income_from_other_sources');
    }
};

