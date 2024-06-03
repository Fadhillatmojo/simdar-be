<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Donor;

class DonorSeeder extends Seeder
{
    public function run()
    {
        $donors = [];

        $bloodTypes = ['A', 'B', 'AB', 'O'];
        $rhesusTypes = ['negatif', 'positif'];
        $genders = ['L', 'P'];

        for ($i = 0; $i < 10; $i++) {
            $donors[] = [
                'name' => 'Donor ' . ($i + 1),
                'gender' => $genders[array_rand($genders)],
                'blood_type' => $bloodTypes[array_rand($bloodTypes)],
                'rhesus_type' => $rhesusTypes[array_rand($rhesusTypes)],
                'date_of_birth' => Carbon::now()->subYears(rand(18, 60))->subMonths(rand(0, 11))->subDays(rand(0, 30)),
                'address' => 'Address ' . ($i + 1),
                'phone_number' => '1234567890', // You can generate random phone numbers here
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
                'updated_at' => Carbon::now()->subDays(rand(0, 30)),
            ];
        }

        Donor::insert($donors);
    }
}
