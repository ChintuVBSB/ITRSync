<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('self_occupied_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('income_from_house_property_id')->constrained()->onDelete('cascade');

            $table->string('property_address')->nullable();
            $table->string('interest_certificate')->nullable(); // File path
            $table->decimal('ownership_percent', 5, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('self_occupied_properties');
    }
};
