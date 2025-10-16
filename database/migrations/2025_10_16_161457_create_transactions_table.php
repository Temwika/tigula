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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique();
            $table->foreignId('farmer_id')->constrained()->onDelete('cascade');
            $table->foreignId('grain_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('depot_id')->constrained()->onDelete('cascade');
            $table->decimal('weight_kg', 10, 2);
            $table->decimal('price_per_kg', 8, 2);
            $table->decimal('total_amount', 12, 2);
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->string('quality_grade')->nullable();
            $table->decimal('moisture_content', 5, 2)->nullable();
            $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->timestamp('transaction_date')->useCurrent();
            $table->timestamps();

            $table->index(['status', 'transaction_date']);
            $table->index('transaction_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
