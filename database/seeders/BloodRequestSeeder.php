<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\BloodRequest;

class BloodRequestSeeder extends Seeder
{
    public function run()
    {
        $requests = [];

        for ($i = 0; $i < 10; $i++) {
            $requests[] = [
                'requester_hf_id' => rand(1, 5), // ID dari fasilitas kesehatan pengirim
                'responder_hf_id' => rand(1, 5), // ID dari fasilitas kesehatan penerima
                'responder_donor_id' => rand(1, 10), // ID dari donor yang merespons
                'quantity' => rand(1, 10),
                'status' => ['accepted', 'rejected', 'deleted', 'pending'][rand(0, 3)],
                'purpose' => 'Purpose of request ' . ($i + 1),
                'request_date' => Carbon::now()->subDays(rand(0, 30)),
                'confirmed_date' => rand(0, 1) ? Carbon::now()->subDays(rand(0, 30)) : null,
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
                'updated_at' => Carbon::now()->subDays(rand(0, 30)),
            ];
        }

        BloodRequest::insert($requests);
    }
}
