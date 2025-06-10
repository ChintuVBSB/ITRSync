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
        Schema::create('normal_businesses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('income_from_business_id')->constrained()->onDelete('cascade');

        $table->decimal('total_sales', 12, 2)->nullable();
        $table->decimal('total_expenses', 12, 2)->nullable();
        $table->string('pl_statement')->nullable(); // File path for Profit & Loss statement

        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('normal_businesses');
    }
};
