<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\BloodStock;

class BloodStockSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 10) as $index) {
            BloodStock::create([
                'donation_id' => rand(1, 10), // Assuming there are 10 blood donations in the database
                'hf_id' => rand(1, 5), // Assuming there are 5 health facilities in the database
                'entry_date' => Carbon::now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
