<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\HealthFacility;
use Illuminate\Database\Seeder;
use Database\Seeders\DonorSeeder;
use Database\Seeders\BloodStockSeeder;
use Database\Seeders\BloodUsageSeeder;
use Database\Seeders\BloodRequestSeeder;
use Database\Seeders\BloodDonationSeeder;
use Database\Seeders\HealthFacilitySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            HealthFacilitySeeder::class,
            DonorSeeder::class,
            BloodDonationSeeder::class,
            BloodStockSeeder::class,
            BloodRequestSeeder::class,
            BloodUsageSeeder::class
        ]);
    }
}
