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
        Schema::create('firm_incomes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('income_from_business_id')->constrained()->onDelete('cascade');

    $table->string('name_pan')->nullable(); // Name and PAN of Firm
    $table->decimal('share_percent', 5, 2)->nullable();
    $table->decimal('remuneration', 12, 2)->nullable();
    $table->decimal('interest', 12, 2)->nullable();
    $table->decimal('profit_or_loss', 12, 2)->nullable();
    $table->decimal('closing_balance', 12, 2)->nullable();

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firm_incomes');
    }
};
