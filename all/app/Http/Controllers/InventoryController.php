<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('products')->get();
        return view('dashboard.inventory.index')->with(['inventories' => $inventories]);
    }

    public function add($id)
    {
        $product = Product::find($id);
        Inventory::create([
           'merch_id'=> Auth::guard('merchant')->user()->id,
            'product_id'=>$product->id,
        ]);
        return back()->with('message', 'Product Added to Inventory successfully');
    }

    public function store(Request $request, $id)
    {

    }

    public function addUnit(Request $request, $id)
    {
        $request->validate([
           'unit' => 'required'
        ]);
//        dd($request->all());
        $inventory = Inventory::find($id);

        $inventory->unit = $request->unit;
        $inventory->save();
        return back()->with('message', 'Product Quantity added successfully');
    }
}
