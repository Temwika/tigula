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
        // Insert grain types if they don't exist
        $grainTypes = [
            ['name' => 'Maize', 'current_price' => 150.00, 'unit' => 'kg', 'description' => 'White/Yellow Maize', 'is_active' => true],
            ['name' => 'Soya Beans', 'current_price' => 200.00, 'unit' => 'kg', 'description' => 'Soya Beans', 'is_active' => true],
            ['name' => 'Groundnuts', 'current_price' => 180.00, 'unit' => 'kg', 'description' => 'Groundnuts', 'is_active' => true],
            ['name' => 'Sunflower', 'current_price' => 170.00, 'unit' => 'kg', 'description' => 'Sunflower Seeds', 'is_active' => true],
        ];

        foreach ($grainTypes as $grainType) {
            \DB::table('grain_types')->updateOrInsert(
                ['name' => $grainType['name']],
                array_merge($grainType, [
                    'created_at' => now(),
                    'updated_at' => now()
                ])
            );
        }

        // Insert depots if they don't exist
        $depots = [
            ['name' => 'Sinda Main Depot', 'location' => 'Sinda Town', 'district' => 'Sinda', 'province' => 'Eastern', 'manager_name' => 'John Mwansa', 'contact_phone' => '+260971234567', 'is_active' => true],
            ['name' => 'Katete Depot', 'location' => 'Katete District', 'district' => 'Katete', 'province' => 'Eastern', 'manager_name' => 'Mary Phiri', 'contact_phone' => '+260977654321', 'is_active' => true],
            ['name' => 'Chipata Central', 'location' => 'Chipata Town', 'district' => 'Chipata', 'province' => 'Eastern', 'manager_name' => 'Peter Banda', 'contact_phone' => '+260966123456', 'is_active' => true],
        ];

        foreach ($depots as $depot) {
            \DB::table('depots')->updateOrInsert(
                ['name' => $depot['name']],
                array_merge($depot, [
                    'created_at' => now(),
                    'updated_at' => now()
                ])
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
