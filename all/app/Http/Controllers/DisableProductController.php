<?php

namespace App\Http\Controllers;

use App\Models\DisableProduct;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisableProductController extends Controller
{
    public function disable($id)
    {
        $inventory_product = Inventory::find($id);
//        dd($inventory_product);
        DisableProduct::create([
            'merch_id'=> Auth::guard('merchant')->user()->id,
            'product_id'=>$inventory_product->product_id,
        ]);
        $inventory_product->status = 0;
        $inventory_product->save();
        return back()->with('message', 'Product Disable Successfully');
    }
}
