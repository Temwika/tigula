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
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('nrc_number')->unique();
            $table->string('full_name');
            $table->string('phone_number')->nullable();
            $table->string('village');
            $table->string('district');
            $table->string('province');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('depot_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_verified')->default(false);
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->integer('farming_experience_years')->nullable();
            $table->decimal('land_size_hectares', 8, 2)->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('mobile_money_number')->nullable();
            $table->timestamp('verification_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['is_verified', 'district']);
            $table->index('nrc_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmers');
    }
};
