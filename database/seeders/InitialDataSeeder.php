<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\GrainType;
use App\Models\Depot;
use App\Models\Farmer;
use App\Observers\AuditLogObserver;
use Illuminate\Support\Facades\Hash;

class InitialDataSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@tigula.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '+260971234567'
        ]);

        // Create aggregator user
        $aggregator = User::create([
            'name' => 'John Aggregator',
            'email' => 'aggregator@tigula.com',
            'password' => Hash::make('aggregator123'),
            'role' => 'aggregator',
            'phone' => '+260971234568'
        ]);

        // Create grain types
        GrainType::create([
            'name' => 'Maize',
            'current_price' => 185.00,
            'unit' => 'per 25kg bag',
            'description' => 'White maize grain'
        ]);

        GrainType::create([
            'name' => 'Soybeans',
            'current_price' => 420.00,
            'unit' => 'per 25kg bag',
            'description' => 'Premium soybeans'
        ]);

        GrainType::create([
            'name' => 'Groundnuts',
            'current_price' => 380.00,
            'unit' => 'per 25kg bag',
            'description' => 'Shelled groundnuts'
        ]);

        GrainType::create([
            'name' => 'Sunflower',
            'current_price' => 295.00,
            'unit' => 'per 25kg bag',
            'description' => 'Sunflower seeds'
        ]);

        // Create depots - Focus on Eastern Province with Sinda District pilot
        Depot::create([
            'name' => 'Sinda District Depot',
            'location' => 'Sinda Boma',
            'district' => 'Sinda',
            'province' => 'Eastern Province',
            'manager_name' => 'Christopher Phiri',
            'contact_phone' => '+260971111001'
        ]);

        Depot::create([
            'name' => 'Nyimba Collection Point',
            'location' => 'Nyimba Trading Center',
            'district' => 'Sinda',
            'province' => 'Eastern Province',
            'manager_name' => 'Grace Tembo',
            'contact_phone' => '+260971111002'
        ]);

        Depot::create([
            'name' => 'Mwami Rural Depot',
            'location' => 'Mwami Village',
            'district' => 'Sinda',
            'province' => 'Eastern Province',
            'manager_name' => 'James Kunda',
            'contact_phone' => '+260971111003'
        ]);

        Depot::create([
            'name' => 'Chipata Regional Hub',
            'location' => 'Industrial Area',
            'district' => 'Chipata',
            'province' => 'Eastern Province',
            'manager_name' => 'Sarah Banda',
            'contact_phone' => '+260971111004'
        ]);

        // Create sample small-scale farmers from Sinda District, Eastern Province
        Farmer::create([
            'nrc_number' => '123456/78/1',
            'full_name' => 'Joseph Tembo',
            'phone_number' => '+260977123456',
            'village' => 'Mkaika Village',
            'district' => 'Sinda',
            'province' => 'Eastern Province',
            'is_verified' => true,
            'verification_date' => now(),
            'notes' => 'Small-scale farmer, 2.5 hectares, 15 years experience'
        ]);

        Farmer::create([
            'nrc_number' => '234567/89/1',
            'full_name' => 'Margaret Mwanza',
            'phone_number' => '+260966234567',
            'village' => 'Nyimba Village',
            'district' => 'Sinda',
            'province' => 'Eastern Province',
            'is_verified' => true,
            'verification_date' => now(),
            'notes' => 'Women\'s cooperative leader, 1.8 hectares, groundnut specialist'
        ]);

        Farmer::create([
            'nrc_number' => '345678/90/1',
            'full_name' => 'Brighton Nyirenda',
            'phone_number' => '+260955345678',
            'village' => 'Kakoma Village',
            'district' => 'Sinda',
            'province' => 'Eastern Province',
            'is_verified' => true,
            'verification_date' => now(),
            'notes' => 'Youth farmer (28 years), 3.2 hectares, climate-smart agriculture'
        ]);

        Farmer::create([
            'nrc_number' => '456789/01/1',
            'full_name' => 'Agnes Kachepa',
            'phone_number' => '+260977456789',
            'village' => 'Chikumbi Village',
            'district' => 'Sinda',
            'province' => 'Eastern Province',
            'is_verified' => true,
            'verification_date' => now(),
            'notes' => 'Sunflower specialist, 2.1 hectares, premium quality producer'
        ]);

        Farmer::create([
            'nrc_number' => '567890/12/1',
            'full_name' => 'Daniel Sakala',
            'phone_number' => '+260966567890',
            'village' => 'Mwami Village',
            'district' => 'Sinda',
            'province' => 'Eastern Province',
            'is_verified' => true,
            'verification_date' => now(),
            'notes' => 'Conservation farmer, 2.8 hectares, no-till practices'
        ]);

        Farmer::create([
            'nrc_number' => '678901/23/1',
            'full_name' => 'Elizabeth Mulenga',
            'phone_number' => '+260955678901',
            'village' => 'Kapamba Village',
            'district' => 'Sinda',
            'province' => 'Eastern Province',
            'is_verified' => true,
            'verification_date' => now(),
            'notes' => 'Organic farming advocate, 2.3 hectares, certified organic'
        ]);
    }
}
