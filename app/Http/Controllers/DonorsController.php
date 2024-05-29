<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Donor;
use Faker\Core\Blood;
use Illuminate\Http\Request;
use App\Models\BloodDonation;

class DonorsController extends Controller
{
    public function getDonors()
    {
        try {
            $donors = Donor::all();

            // Donor::join('blood_donations', 'donors.donor_id', '=', 'blood_donations.donor_id')
            //     ->select('donors.*', 'blood_donations.donor_date')
            //     ->get();
            return response()->json($donors);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function getDonorById($id)
    {
        try {
            $donor = Donor::where('donor_id', $id)->get();
            return response()->json($donor);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function createDonor(Request $request)
    {
        try {
            $donor = new Donor;
            $donor->name = $request->name;
            $donor->gender = $request->gender;
            $donor->blood_type = $request->blood_type;
            $donor->rhesus_type = $request->rhesus_type;
            $donor->date_of_birth = $request->date_of_birth;
            $donor->address = $request->address;
            $donor->phone_number = $request->phone_number;
            $donor->save();

            return response()->json($donor);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function getDonorsAll()
    {
        try {
            $donor = Donor::all();
            return response()->json(["anjay"=> "anjay"], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
