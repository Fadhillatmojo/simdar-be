<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\HealthFacility;

class HealthFacilitySeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 5) as $index) {
            HealthFacility::create([
                'name' => 'Health Facility ' . $index,
                'address' => 'Address ' . $index,
                'phone_number' => '1234567890', // You can generate random phone numbers here
                'email' => 'facility' . $index . '@example.com',
                'password' => Hash::make('password'), // You can use a default password or generate random ones
            ]);
        }
    }
}
