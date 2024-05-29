<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function login(Request $request)
    {
        try {
            // validasi input
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            // Checking apakah usernya itu ada atau tidak
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                $user = User::where('username', $request->email)->first();
            }

            // Checking apakah usernya itu passwordnya bener atau salah, kalau salah, dia bakal throw exception
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.']
                ]);
            }

            return $user->createToken($request->email)->plainTextToken;
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function registrasi(Request $request)
    {
        $validated = $request->validate([
            'hospital_id' => 'required',
            'username' => 'required|max:50',
            'alamat_email' => 'required|email',
            'password' => 'required|max:50',
        ]);

        try{
            $user = AdminHospital::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'hospital_id' => $validated['hospital_id'],
                'password' => Hash::make($validated['password']),
            ]);
            return response()->json([
                'username' => $user->username,
                'status' => 'Success'
            ],200);
        }catch(Exception $e){
            return response()->json([
                'error' => $e
            ],400);
        }
    }
}
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logout Success'], 200);
        } catch (Exception $e) {
            return response()->json([
                "error" => $e->getMessage()
            ]);
        }
    }
}

