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
        Schema::create('grain_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->decimal('price_per_kg', 8, 2);
            $table->boolean('is_active')->default(true);
            $table->decimal('seasonal_price_factor', 5, 3)->default(1.000);
            $table->string('quality_grade')->nullable();
            $table->timestamps();

            $table->index(['is_active', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grain_types');
    }
};
