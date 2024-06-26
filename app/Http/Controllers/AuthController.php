<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\HealthFacility;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'phone_number' => 'required|string',
                'email' => 'required|string|email|max:255|unique:health_facilities',
                'password' => 'required|string|min:8',
            ]);

            $healthFacility = HealthFacility::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone_number'=> $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $healthFacility->createToken('auth_token')->plainTextToken;

            return response()->json(['access_token' => $token, 'token_type' => 'Bearer'], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $healthFacility = HealthFacility::where('email', $request->email)->first();

            if (!$healthFacility || !Hash::check($request->password, $healthFacility->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $healthFacility->createToken('auth_token')->plainTextToken;

            return response()->json(['access_token' => $token, 'token_type' => 'Bearer'], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json(['message' => 'Logged out successfully'], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getFaskes(Request $request)
    {
        try {
            $user = $request->user();
            return response()->json([
                'status' => 'Success',
                'message' => 'Data berhasil terambil',
                'data' => $user
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function updateFaskes(Request $request)
    {
        try {
            $user_id = auth()->user()->id;
            $request->validate([
                'name' => 'sometimes|string|max:255',
                'address' => 'sometimes|string',
                'phone_number' => 'sometimes|string',
                'email' => 'sometimes|string|email|max:255|unique:health_facilities'
            ]);
            $faskes = HealthFacility::findOrFail($user_id);
            // Ambil semua data request kecuali '_method' dan '_token'
            $data = $request->except(['_method', '_token']);
            // Filter atribut yang kosong
            $filteredData = array_filter($data, function ($value) {
                return !is_null($value) && $value !== '';
            });
            // Update hanya atribut yang diisi
            $faskes->update($filteredData);

            return response()->json([
                'status' => "Success",
                'message' => "Data Faskesmu Berhasil Di Update"
            ], 500);
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
}
