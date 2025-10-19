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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');
            $table->string('payment_reference')->unique();
            $table->decimal('amount', 12, 2);
            $table->enum('payment_method', ['airtel_money', 'mtn_money', 'zamtel_money', 'bank_transfer', 'cash'])->default('airtel_money');
            $table->string('mobile_number')->nullable();
            $table->string('mobile_money_reference')->nullable();
            $table->string('failure_reason')->nullable();
            $table->date('payment_date');
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('processed_at')->nullable();
            $table->text('notes')->nullable();
            $table->json('gateway_response')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index('payment_reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
