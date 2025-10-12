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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // sms, email, push, etc.
            $table->string('recipient'); // phone number or email
            $table->text('message'); // notification content
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->string('status')->default('pending'); // pending, sent, failed
            $table->timestamp('sent_at')->nullable();
            $table->text('response')->nullable(); // gateway response
            $table->timestamp('failed_at')->nullable();
            $table->integer('retry_count')->default(0);
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('set null');
            $table->index(['status', 'type']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
