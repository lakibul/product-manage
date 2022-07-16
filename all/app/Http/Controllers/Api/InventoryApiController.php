<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryApiController extends Controller
{
    public function index()
    {
        $data['inventories'] = Inventory::with('products')->get();
        return response()->json($data, 200);
    }

    public function add($id)
    {
        $product = Product::find($id);
        Inventory::create([
            'merch_id'=> Auth::guard('merchant')->user()->id,
            'product_id'=>$product->id,
        ]);
        $product->status = 0;
        $product->save();
        return response()->json(['message'=>'Added to the inventory'], 200);
    }


    public function addUnit(Request $request, $id)
    {
        $request->validate([
            'unit' => 'required'
        ]);
        $inventory = Inventory::find($id);

        $inventory->unit = $request->unit;
        $inventory->save();
        return response()->json(['message'=>'Added the product Unit'], 200);
    }
}
