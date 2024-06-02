<?php

namespace App\Http\Controllers;

use App\Models\BloodDonation;
use App\Http\Requests\StoreBloodDonationRequest;
use App\Http\Requests\UpdateBloodDonationRequest;
use App\Models\BloodStock;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BloodDonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'donor_id' => 'required|integer',
                'donor_date' => 'required|date',
            ]);
            
            $healthFacility = auth()->user()->id;

            // Cek apakah pengguna memiliki fasilitas kesehatan yang valid
            if ($healthFacility === null) {
                return response()->json(['error' => 'User does not have a valid health facility.'], 400);
            }

            $bloodDonation = new BloodDonation();
            $bloodDonation->hf_id = auth()->user()->id;
            $bloodDonation->donor_id = $request->donor_id;
            $bloodDonation->donor_date = $request->donor_date;
            $bloodDonation->save();

            $bloodStock = BloodStock::create([
                'donation_id' => $bloodDonation->id,
                'hf_id' => auth()->user()->id,
                'entry_date' => $request->donor_date,
            ]);

            return response()->json($bloodDonation, 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BloodDonation $bloodDonation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BloodDonation $bloodDonation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBloodDonationRequest $request, BloodDonation $bloodDonation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BloodDonation $bloodDonation)
    {
        //
    }
}
