<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\BloodUsage;

class BloodUsageSeeder extends Seeder
{
    public function run()
    {
        foreach (range(1, 10) as $index) {
            BloodUsage::create([
                'requester_donor_id' => rand(1, 10), // Assuming there are 10 donors in the database
                'stock_id' => rand(1, 10), // Assuming there are 10 blood stocks in the database
                'hf_id' => rand(1, 5), // Assuming there are 5 health facilities in the database
                'purpose' => 'Purpose of usage ' . $index,
                'date' => Carbon::now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
