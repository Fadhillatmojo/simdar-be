<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Donor;
use App\Models\BloodDonation;
use App\Models\HealthFacility;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BloodDonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ensure you have some donors and health facilities in your database before running this seeder.
        $donors = Donor::all();
        $healthFacilities = HealthFacility::all();

        if ($donors->count() == 0 || $healthFacilities->count() == 0) {
            $this->command->info('Please seed the donors and health_facilities tables first!');
            return;
        }

        foreach (range(1, 10) as $index) {
            BloodDonation::create([
                'hf_id' => $healthFacilities->random()->id,
                'donor_id' => $donors->random()->id,
                'donor_date' => Carbon::now()->subDays(rand(0, 365)),
            ]);
        }
    }
}
