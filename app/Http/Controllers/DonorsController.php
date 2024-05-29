<?php

namespace App\Http\Controllers;

use App\Models\BloodDonation;
use Illuminate\Http\Request;
use App\Models\Donor;
use Faker\Core\Blood;

class DonorsController extends Controller
{
    public function getDonors()
    {
        $donors = Donor::all();
        
        // Donor::join('blood_donations', 'donors.donor_id', '=', 'blood_donations.donor_id')
        //     ->select('donors.*', 'blood_donations.donor_date')
        //     ->get();
        return response()->json($donors);
    }

    public function getDonorById($id)
    {
        $donor = Donor::where('donor_id', $id)->get();
        return response()->json($donor);
    }

    public function createDonor(Request $request)
    {
        $donor = new Donor;
        $donor->name = $request->name;
        $donor->gender= $request->gender;
        $donor->blood_type = $request->blood_type;
        $donor->rhesus_type = $request->rhesus_type;
        $donor->date_of_birth = $request->date_of_birth;
        $donor->address = $request->address;
        $donor->phone_number = $request->phone_number;
        $donor->save();

        return response()->json($donor);
    }

    public function getDonorsAll()
    {
        $donor = Donor::all();
        return response()->json($donor);
    }
}
