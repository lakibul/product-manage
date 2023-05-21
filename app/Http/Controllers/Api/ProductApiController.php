<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function updateStatus($id)
    {
        $message = Product::updateStatus($id);
        return response()->json(['message'=>$message], 201);
    }

    public function showInventory()
    {
        $products = Product::where('status',1)->get();
        return response()->json(['products'=>$products], 200);
    }
}
