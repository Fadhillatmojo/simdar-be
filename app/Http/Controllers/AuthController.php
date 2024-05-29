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
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

}

// class AuthController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         //
//     }
//     public function login(Request $request)
//     {
//         try {
//             // validasi input
//             $request->validate([
//                 'email' => 'required',
//                 'password' => 'required'
//             ]);

//             // Checking apakah usernya itu ada atau tidak
//             $user = User::where('email', $request->email)->first();

//             if (!$user) {
//                 $user = User::where('username', $request->email)->first();
//             }

//             // Checking apakah usernya itu passwordnya bener atau salah, kalau salah, dia bakal throw exception
//             if (!$user || !Hash::check($request->password, $user->password)) {
//                 throw ValidationException::withMessages([
//                     'email' => ['The provided credentials are incorrect.']
//                 ]);
//             }

//             return $user->createToken($request->email)->plainTextToken;
//         } catch (Exception $e) {
//             return response()->json([
//                 'error' => $e->getMessage()
//             ]);
//         }
//     }
//     public function registrasi(Request $request)
//     {
//         $validated = $request->validate([
//             'hospital_id' => 'required',
//             'username' => 'required|max:50',
//             'alamat_email' => 'required|email',
//             'password' => 'required|max:50',
//         ]);

//         try{
//             $user = AdminHospital::create([
//                 'username' => $validated['username'],
//                 'email' => $validated['email'],
//                 'hospital_id' => $validated['hospital_id'],
//                 'password' => Hash::make($validated['password']),
//             ]);
//             return response()->json([
//                 'username' => $user->username,
//                 'status' => 'Success'
//             ],200);
//         }catch(Exception $e){
//             return response()->json([
//                 'error' => $e
//             ],400);
//         }
//     }
// }
//     public function logout(Request $request)
//     {
//         try {
//             $request->user()->currentAccessToken()->delete();
//             return response()->json(['message' => 'Logout Success'], 200);
//         } catch (Exception $e) {
//             return response()->json([
//                 "error" => $e->getMessage()
//             ]);
//         }
//     }
// }
