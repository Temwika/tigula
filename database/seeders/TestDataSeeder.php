<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Depot;
use App\Models\GrainType;
use App\Models\Farmer;
use App\Models\Transaction;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create test users
        $admin = User::firstOrCreate(
            ['email' => 'admin@graintrade.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_ADMIN,
                'is_active' => true,
            ]
        );

        $aggregator = User::firstOrCreate(
            ['email' => 'aggregator@graintrade.com'],
            [
                'name' => 'John Aggregator',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_AGGREGATOR,
                'is_active' => true,
            ]
        );

        $farmer1 = User::firstOrCreate(
            ['email' => 'mary@graintrade.com'],
            [
                'name' => 'Mary Farmer',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_FARMER,
                'is_active' => true,
            ]
        );

        $farmer2 = User::firstOrCreate(
            ['email' => 'peter@graintrade.com'],
            [
                'name' => 'Peter Farmer',
                'password' => Hash::make('password123'),
                'role' => User::ROLE_FARMER,
                'is_active' => true,
            ]
        );

        // Get or create test depots
        $depot1 = Depot::firstOrCreate(
            ['name' => 'Central Lusaka Depot'],
            [
                'location' => 'Lusaka, Zambia',
                'address' => 'Industrial Area, Plot 123',
                'phone' => '+260977123456',
                'manager_name' => 'John Aggregator',
                'capacity_tonnes' => 50000.00,
                'latitude' => -15.3875,
                'longitude' => 28.3228,
                'is_active' => true,
            ]
        );

        $depot2 = Depot::firstOrCreate(
            ['name' => 'Northern Kasama Depot'],
            [
                'location' => 'Kasama, Northern Province',
                'address' => 'Kasama Town, Commercial Area',
                'phone' => '+260966789012',
                'manager_name' => 'Sarah Manager',
                'capacity_tonnes' => 30000.00,
                'latitude' => -10.2130,
                'longitude' => 31.1810,
                'is_active' => true,
            ]
        );

        // Assign aggregator to depot
        $aggregator->update(['depot_id' => $depot1->id]);

        // Create test grain types
        $maize = GrainType::firstOrCreate(
            ['code' => 'MAIZE_001'],
            [
                'name' => 'White Maize',
                'price_per_kg' => 8.50,
                'seasonal_price_factor' => 1.200,
                'quality_grade' => 'Grade A',
                'description' => 'Premium white maize variety suitable for human consumption',
                'is_active' => true,
            ]
        );

        $soya = GrainType::firstOrCreate(
            ['code' => 'SOYA_001'],
            [
                'name' => 'Soya Beans',
                'price_per_kg' => 12.00,
                'seasonal_price_factor' => 1.100,
                'quality_grade' => 'Premium',
                'description' => 'High protein soya beans for oil extraction and animal feed',
                'is_active' => true,
            ]
        );

        $groundnuts = GrainType::firstOrCreate(
            ['code' => 'NUTS_001'],
            [
                'name' => 'Groundnuts',
                'price_per_kg' => 15.00,
                'seasonal_price_factor' => 1.300,
                'quality_grade' => 'Export Grade',
                'description' => 'Premium groundnuts for local and export markets',
                'is_active' => true,
            ]
        );

        // Create test farmers
        $farmerProfile1 = Farmer::firstOrCreate(
            ['nrc_number' => '123456/78/1'],
            [
                'user_id' => $farmer1->id,
                'depot_id' => $depot1->id,
                'full_name' => 'Mary Mwansa Farmer',
                'phone_number' => '+260977654321',
                'village' => 'Kabulonga',
                'district' => 'Lusaka',
                'province' => 'Lusaka Province',
                'farming_experience_years' => 15,
                'land_size_hectares' => 25.5,
                'bank_name' => 'Zanaco Bank',
                'bank_account_number' => '1234567890',
                'mobile_money_number' => '+260977654321',
                'is_verified' => true,
                'verification_date' => now(),
            ]
        );

        $farmerProfile2 = Farmer::firstOrCreate(
            ['nrc_number' => '987654/32/1'],
            [
                'user_id' => $farmer2->id,
                'depot_id' => $depot2->id,
                'full_name' => 'Peter Banda Farmer',
                'phone_number' => '+260966123789',
                'village' => 'Mwamba',
                'district' => 'Kasama',
                'province' => 'Northern Province',
                'farming_experience_years' => 20,
                'land_size_hectares' => 40.0,
                'bank_name' => 'FNB Bank',
                'bank_account_number' => '9876543210',
                'mobile_money_number' => '+260966123789',
                'is_verified' => true,
                'verification_date' => now(),
            ]
        );

        // Create test transactions
        $transaction1 = Transaction::create([
            'farmer_id' => $farmerProfile1->id,
            'grain_type_id' => $maize->id,
            'depot_id' => $depot1->id,
            'weight_kg' => 500.00,
            'price_per_kg' => 10.20,
            'status' => Transaction::STATUS_COMPLETED,
            'quality_grade' => 'Grade A',
            'moisture_content' => 12.5,
            'recorded_by' => $aggregator->id,
            'notes' => 'Excellent quality white maize from Mary\'s farm',
            'transaction_date' => now()->subDays(2),
        ]);

        $transaction2 = Transaction::create([
            'farmer_id' => $farmerProfile1->id,
            'grain_type_id' => $soya->id,
            'depot_id' => $depot1->id,
            'weight_kg' => 300.00,
            'price_per_kg' => 13.20,
            'status' => Transaction::STATUS_PENDING,
            'quality_grade' => 'Premium',
            'moisture_content' => 10.0,
            'recorded_by' => $aggregator->id,
            'notes' => 'High quality soya beans ready for processing',
            'transaction_date' => now()->subDays(1),
        ]);

        $transaction3 = Transaction::create([
            'farmer_id' => $farmerProfile2->id,
            'grain_type_id' => $groundnuts->id,
            'depot_id' => $depot2->id,
            'weight_kg' => 200.00,
            'price_per_kg' => 19.50,
            'status' => Transaction::STATUS_COMPLETED,
            'quality_grade' => 'Export Grade',
            'moisture_content' => 8.0,
            'recorded_by' => $admin->id,
            'notes' => 'Premium groundnuts suitable for export market',
            'transaction_date' => now(),
        ]);

        // Create test payments
        Payment::firstOrCreate(
            ['transaction_id' => $transaction1->id],
            [
                'payment_reference' => 'PAY' . time() . '001',
                'amount' => $transaction1->total_amount,
                'payment_method' => Payment::METHOD_AIRTEL_MONEY,
                'mobile_number' => $farmerProfile1->phone_number,
                'status' => Payment::STATUS_COMPLETED,
                'mobile_money_reference' => 'MM' . time() . '1234',
                'payment_date' => now()->subDays(2),
                'processed_by' => $aggregator->id,
                'processed_at' => now()->subDays(2),
                'gateway_response' => json_encode([
                    'success' => true,
                    'reference' => 'MM' . time() . '1234',
                    'message' => 'Payment completed successfully'
                ]),
            ]
        );

        Payment::firstOrCreate(
            ['transaction_id' => $transaction2->id],
            [
                'payment_reference' => 'PAY' . time() . '002',
                'amount' => $transaction2->total_amount,
                'payment_method' => Payment::METHOD_MTN_MONEY,
                'mobile_number' => $farmerProfile1->phone_number,
                'status' => Payment::STATUS_PENDING,
                'payment_date' => now()->subDays(1),
                'processed_by' => $aggregator->id,
            ]
        );

        Payment::firstOrCreate(
            ['transaction_id' => $transaction3->id],
            [
                'payment_reference' => 'PAY' . time() . '003',
                'amount' => $transaction3->total_amount,
                'payment_method' => Payment::METHOD_ZAMTEL_MONEY,
                'mobile_number' => $farmerProfile2->phone_number,
                'status' => Payment::STATUS_COMPLETED,
                'mobile_money_reference' => 'ZM' . time() . '5678',
                'payment_date' => now(),
                'processed_by' => $admin->id,
                'processed_at' => now(),
                'gateway_response' => json_encode([
                    'success' => true,
                    'reference' => 'ZM' . time() . '5678',
                    'message' => 'Payment completed successfully'
                ]),
            ]
        );

        $this->command->info('✅ Test data created successfully!');
        $this->command->info('📧 Login Credentials:');
        $this->command->info('   Admin: admin@graintrade.com / password123');
        $this->command->info('   Aggregator: aggregator@graintrade.com / password123');
        $this->command->info('   Farmers: mary@graintrade.com, peter@graintrade.com / password123');
    }
}