<?php

namespace App\Http\Controllers;

use App\Models\BloodStock;
use Exception;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function getAllStock()
    {
        try {
            $stocks = BloodStock::all();
            // percabangan kalau datanya kosongks
            if ($stocks->isEmpty()) {
                return response()->json([
                    'message' => 'Not found'
                ], 404);
            }
            return response()->json($stocks);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getStockById($id)
    {
        $stock = BloodStock::where('hf_id', $id)->get();
        return response()->json($stock);
    }

    public function getSelfStock()
    {
        $stock = BloodStock::where('hf_id', auth()->user()->id)->get();
        return response()->json($stock);
    }
}
