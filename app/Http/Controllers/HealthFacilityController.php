<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\HealthFacility;
use App\Http\Requests\StoreHealthFacilityRequest;
use App\Http\Requests\UpdateHealthFacilityRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HealthFacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $all_faskes = HealthFacility::all();
            return response()->json([
                'status' => 'Success',
                'message' => 'Data berhasil terambil',
                'data' => $all_faskes
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function getOtherFaskes(String $id)
    {
        try {
            $faskes_lain = HealthFacility::findOrFail($id);
            return response()->json([
                'status' => 'Success',
                'message' => 'Data berhasil terambil',
                'data' => $faskes_lain
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => "error",
                'message' => "Faskes Tidak Ditemukan"
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
    public function store(StoreHealthFacilityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HealthFacility $healthFacility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HealthFacility $healthFacility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHealthFacilityRequest $request, HealthFacility $healthFacility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HealthFacility $healthFacility)
    {
        //
    }
}
