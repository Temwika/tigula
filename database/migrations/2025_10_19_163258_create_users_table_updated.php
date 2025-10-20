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
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_login_at')->nullable()->after('email_verified_at');
            $table->string('phone')->nullable()->after('password');
            $table->enum('role', ['admin', 'aggregator', 'farmer'])->default('farmer')->after('phone');
            $table->boolean('is_active')->default(true)->after('role');
            $table->foreignId('depot_id')->nullable()->constrained('depots')->onDelete('set null')->after('is_active');

            $table->index(['role', 'is_active']);
            $table->index('depot_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_login_at', 'phone', 'role', 'is_active', 'depot_id']);
        });
    }
};
