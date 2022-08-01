<?php

namespace App\Http\Controllers;

use App\Models\DisableProduct;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisableProductController extends Controller
{
    public function index()
    {
        $data['disabledProducts'] = DisableProduct::with('inventory', 'product')->get();
        return view('dashboard.disabled-product.index', $data);
    }

    public function disable($id)
    {
        $inventory_product = Inventory::find($id);
        DisableProduct::create([
            'merch_id' => Auth::guard('merchant')->user()->id,
            'product_id' => $inventory_product->product_id,
            'inventory_id' => $inventory_product->id,
        ]);
        $inventory_product->status = 0;
        $inventory_product->save();
        return redirect('/disable-product-index')->with('message', 'Product Disable Successfully');
    }

    public function move($id)
    {

        $product = DisableProduct::find($id);
        $product->inventory->status = 1;
        $product->inventory->save();

        $product->status = 1;
        $product->save();
        return redirect('/inventory')->with('message', 'Product Moved to Inventory Successfully');
    }

}
