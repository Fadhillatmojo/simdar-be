<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\BloodRequest;
use Illuminate\Http\Request;
use App\Http\Resources\SuccessUploadResource;
use App\Http\Requests\StoreBloodRequestRequest;
use App\Http\Requests\UpdateBloodRequestRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\BloodUsage;

class BloodRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user_id = auth()->user()->id;

            $blood_requests = BloodRequest::select('blood_request')
            ->where('responder_hf_id', '=', $user_id); //kasih id user yg login
            return response()->json([
                'status' => 'Success',
                'message' => 'Data berhasil terambil',
                'data' => $blood_requests
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function request(Request $request)
    {
        try {
            $user_id = auth()->user()->id;

            $request->validate([
                // 'requester_hf_id' => 'required',
                'responder_hf_id' => 'required',
                'responder_donor_id' => 'required',
                'quantity' => 'required',
                'purpose' => 'required',
            ]);

            BloodRequest::create([
                'requester_hf_id' => $user_id,
                'responder_hf_id' => $request->responder_hf_id,
                'responder_donor_id' => $request->responder_donor_id,
                'status' => 'pending',
                'quantity' => $request->quantity,
                'purpose' => $request->purpose,
                'request_date' => Carbon::now()
            ]);

            return response()->json(new SuccessUploadResource(), 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function accept(String $id, Request $request)
    {
        try {
            $request->validate([
                'requester_donor_id' => 'required',
                'stock_id' => 'required',
                'purpose' => 'required',
                'date' => 'required',
            ]);
    
            $blood_request = BloodRequest::findOrFail($id);
            // Perbarui status
            $blood_request->status = 'accepted';
            $blood_request->save();

           
            $bloodUsage = new BloodUsage();
            $bloodUsage->hf_id = $blood_request->responder_hf_id;
            $bloodUsage->requester_donor_id = $request->requester_donor_id;
            $bloodUsage->stock_id = $request->stock_id;
            $bloodUsage->purpose = $request->purpose;
            $bloodUsage->date = $request->date;
            $bloodUsage->save();
    
            return response()->json($bloodUsage, 201);

            return response()->json(['message' => 'Blood Request diterima'], 200);

        }  catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'message' => "Blood Request Tidak Ditemukan"
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function reject(String $id)
    {
        try {
            $blood_request = BloodRequest::findOrFail($id);
            // Perbarui status
            $blood_request->status = 'rejected';
            $blood_request->save();
            return response()->json(['message' => 'Blood Request ditolak'], 200);

        }  catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'message' => "Blood Request Tidak Ditemukan"
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
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
