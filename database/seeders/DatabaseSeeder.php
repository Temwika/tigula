<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\GrainType;
use App\Models\Depot;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the Tigula application's database.
     */
    public function run()
    {
        $this->command->info('🌾 Seeding Tigula Platform Database...');
        $this->command->newLine();

        // Clear existing data (optional - comment out if you want to keep existing data)
        $this->command->warn('Clearing existing data...');
        DB::table('payments')->delete();
        DB::table('transactions')->delete();
        DB::table('farmers')->delete();
        DB::table('users')->delete();
        DB::table('grain_types')->delete();
        DB::table('depots')->delete();
        $this->command->info('✅ Existing data cleared');
        $this->command->newLine();

        // Create Admin User
        $this->command->info('Creating admin user...');
        $admin = User::create([
            'name' => 'Tigula Admin',
            'email' => 'admin@tigula.zm',
            'phone' => '+260977000001',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $this->command->info('✅ Admin user created: admin@tigula.zm / password');
        $this->command->newLine();

        // Create Aggregator User
        $this->command->info('Creating aggregator user...');
        $aggregator = User::create([
            'name' => 'Field Aggregator',
            'email' => 'aggregator@tigula.zm',
            'phone' => '+260977000002',
            'password' => Hash::make('password'),
            'role' => 'aggregator',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $this->command->info('✅ Aggregator user created: aggregator@tigula.zm / password');
        $this->command->newLine();

        // Verify passwords work
        $this->command->info('Verifying password hashing...');
        if (Hash::check('password', $admin->password)) {
            $this->command->info('✅ Admin password verified');
        } else {
            $this->command->error('❌ Admin password verification failed!');
        }
        
        if (Hash::check('password', $aggregator->password)) {
            $this->command->info('✅ Aggregator password verified');
        } else {
            $this->command->error('❌ Aggregator password verification failed!');
        }
        $this->command->newLine();

        // Create Grain Types
        $this->command->info('Creating grain types...');
        $grainTypes = [
            [
                'name' => 'Maize',
                'code' => 'MAIZE',
                'description' => 'White and yellow maize varieties commonly grown in Zambia',
                'current_price' => 3.50,
                'unit' => 'kg',
                'is_active' => true
            ],
            [
                'name' => 'Soya Bean',
                'code' => 'SOYA',
                'description' => 'High-protein soya beans for local and export markets',
                'current_price' => 5.00,
                'unit' => 'kg',
                'is_active' => true
            ],
            [
                'name' => 'Sunflower',
                'code' => 'SUNFLOWER',
                'description' => 'Sunflower seeds for oil production',
                'current_price' => 4.50,
                'unit' => 'kg',
                'is_active' => true
            ],
            [
                'name' => 'Groundnuts',
                'code' => 'GROUNDNUT',
                'description' => 'Local groundnuts (peanuts) for consumption and processing',
                'current_price' => 6.00,
                'unit' => 'kg',
                'is_active' => true
            ],
            [
                'name' => 'Wheat',
                'code' => 'WHEAT',
                'description' => 'Wheat grain for milling',
                'current_price' => 4.00,
                'unit' => 'kg',
                'is_active' => true
            ],
            [
                'name' => 'Rice',
                'code' => 'RICE',
                'description' => 'Locally grown rice',
                'current_price' => 7.00,
                'unit' => 'kg',
                'is_active' => true
            ],
        ];

        foreach ($grainTypes as $grain) {
            GrainType::create($grain);
            $this->command->info("  ✓ {$grain['name']} - ZMW {$grain['current_price']}/kg");
        }
        $this->command->newLine();

        // Create Depots
        $this->command->info('Creating depot locations...');
        $depots = [
            [
                'name' => 'Chipata Central Depot',
                'code' => 'TGU-CPT-001',
                'location' => 'Chipata Town Centre, Great East Road',
                'district' => 'Chipata',
                'province' => 'Eastern',
                'contact_person' => 'John Phiri',
                'contact_phone' => '+260977111111',
                'is_active' => true
            ],
            [
                'name' => 'Katete Collection Point',
                'code' => 'TGU-KTE-001',
                'location' => 'Katete Boma, Main Market Area',
                'district' => 'Katete',
                'province' => 'Eastern',
                'contact_person' => 'Mary Banda',
                'contact_phone' => '+260977222222',
                'is_active' => true
            ],
            [
                'name' => 'Petauke Trading Hub',
                'code' => 'TGU-PTK-001',
                'location' => 'Petauke District Centre',
                'district' => 'Petauke',
                'province' => 'Eastern',
                'contact_person' => 'Joseph Zulu',
                'contact_phone' => '+260977333333',
                'is_active' => true
            ],
            [
                'name' => 'Lundazi Grain Center',
                'code' => 'TGU-LDZ-001',
                'location' => 'Lundazi Town, Near Bus Station',
                'district' => 'Lundazi',
                'province' => 'Eastern',
                'contact_person' => 'Grace Mwale',
                'contact_phone' => '+260977444444',
                'is_active' => true
            ],
            [
                'name' => 'Nyimba Collection Site',
                'code' => 'TGU-NYM-001',
                'location' => 'Nyimba Boma',
                'district' => 'Nyimba',
                'province' => 'Eastern',
                'contact_person' => 'Patrick Sakala',
                'contact_phone' => '+260977555555',
                'is_active' => true
            ],
        ];

        foreach ($depots as $depot) {
            Depot::create($depot);
            $this->command->info("  ✓ {$depot['name']} ({$depot['code']})");
        }
        $this->command->newLine();

        // Summary
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('  🎉 TIGULA PLATFORM DATABASE SEEDED!');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->newLine();
        
        $this->command->table(
            ['Account', 'Email', 'Password', 'Role'],
            [
                ['Admin', 'admin@tigula.zm', 'password', 'admin'],
                ['Aggregator', 'aggregator@tigula.zm', 'password', 'aggregator'],
            ]
        );
        
        $this->command->newLine();
        $this->command->info('📊 Summary:');
        $this->command->info('  - Users: 2');
        $this->command->info('  - Grain Types: 6');
        $this->command->info('  - Depots: 5');
        $this->command->newLine();
        $this->command->info('🚀 Next Steps:');
        $this->command->info('  1. Start server: php artisan serve');
        $this->command->info('  2. Visit: http://localhost:8000');
        $this->command->info('  3. Login with credentials above');
        $this->command->newLine();
    }
}