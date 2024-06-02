<?php

namespace App\Http\Controllers;

use App\Models\BloodStock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function getAllStock()
    {
        $stocks = BloodStock::all();
        return response()->json($stocks);
    }

    public function getStockById($id)
    {
        $stock = BloodStock::where('hf_id', $id)->get();
        return response()->json($stock);
    }

    public function getSelfStock(){
        $stock = BloodStock::where('hf_id', auth()->user()->id)->get();
        return response()->json($stock);
    }

}
