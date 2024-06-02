<?php

namespace App\Http\Controllers;

use App\Models\BloodUsage;
use App\Http\Requests\StoreBloodUsageRequest;
use App\Http\Requests\UpdateBloodUsageRequest;
use App\Models\BloodStock;
use Illuminate\Http\Request;


class BloodUsageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function usage(Request $request)
    {
        $request->validate([
            'requester_donor_id' => 'required',
            'stock_id' => 'required',
            'purpose' => 'required',
            'date' => 'required',
        ]);

        $bloodUsage = new BloodUsage();
        $bloodUsage->hf_id = auth()->user()->id;
        $bloodUsage->requester_donor_id = $request->requester_donor_id;
        $bloodUsage->stock_id = $request->stock_id;
        $bloodUsage->purpose = $request->purpose;
        $bloodUsage->date = $request->date;
        $bloodUsage->save();

        return response()->json($bloodUsage, 201);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function list()
    {
        $bloodUsage = BloodUsage::all();
        return response()->json($bloodUsage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBloodUsageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BloodUsage $bloodUsage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BloodUsage $bloodUsage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBloodUsageRequest $request, BloodUsage $bloodUsage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BloodUsage $bloodUsage)
    {
        //
    }
}
