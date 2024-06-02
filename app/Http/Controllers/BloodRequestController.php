<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Http\Requests\StoreBloodRequestRequest;
use App\Http\Requests\UpdateBloodRequestRequest;
use Illuminate\Http\Request;

class BloodRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function request(Request $request)
    {
        // $request->validate([
        //     'requester_hf_id' => 'required',
        //     'responder_hf_id' => 'required',
        //     'responder_donor_id' => 'required',
        //     'quantity' => 'required',
        //     'purpose' => 'required',
        // ]);

        // $bloodRequest = new BloodRequest();
        // $bloodRequest->requester_hf_id = auth()->user()->id;
        // $bloodRequest->responder_hf_id = $request->responder_hf_id;
        // $bloodRequest->responder_donor_id = $request->responder_donor_id;
        // $bloodRequest->quantity = $request->quantity;
        // $bloodRequest->purpose = $request->purpose;
        // $bloodRequest->request_date = now();
        // $bloodRequest->status = 'pending';
        // $bloodRequest->save();

        // $data_request = BloodRequest::select(
        //     'requester_hf_id', 
        //     'responder_donor_id', 
        //     'donors.rhesus_type', // Kolom rhesus_type dari tabel donors
        //     'donors.blood_type', // Kolom blood_type dari tabel donors
        //     'quantity', 
        //     'purpose', 
        //     'request_date', 
        //     'status'
        // )
        // ->join('donors', 'blood_requests.responder_donor_id', '=', 'donors.id')
        // ->where('blood_requests.id', $bloodRequest->id) // Menggunakan blood_requests.id
        // ->first();
    

        // return response()->json($bloodRequest, 201);
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
    public function store(StoreBloodRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBloodRequestRequest $request, BloodRequest $bloodRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BloodRequest $bloodRequest)
    {
        //
    }
}
