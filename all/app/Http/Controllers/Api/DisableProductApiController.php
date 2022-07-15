<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DisableProduct;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisableProductApiController extends Controller
{
    public function disable()
    {
        $inventory_product = Inventory::find($id);
        DisableProduct::create([
            'merch_id' => Auth::guard('merchant')->user()->id,
            'product_id' => $inventory_product->product_id,
            'inventory_id' => $inventory_product->id,
        ]);
        $inventory_product->status = 0;
        $inventory_product->save();
    }
}
