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
        Schema::create('float_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('allocation_number')->unique();
            $table->foreignId('agro_dealer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('field_buyer_id')->constrained('users')->onDelete('cascade');
            $table->decimal('allocated_amount', 10, 2);
            $table->decimal('used_amount', 10, 2)->default(0);
            $table->decimal('remaining_amount', 10, 2);
            $table->enum('status', ['active', 'depleted', 'expired', 'recalled'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamp('allocated_at');
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('recalled_at')->nullable();
            $table->timestamps();
            
            $table->index(['agro_dealer_id', 'status']);
            $table->index(['field_buyer_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('float_allocations');
    }
};
