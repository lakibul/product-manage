<?php

namespace App\Http\Controllers;

use App\Helpers\MerchantLogActivity;
use App\Mail\NotifyMail;
use App\Models\DisableProduct;
use App\Models\Inventory;
use App\Models\Merchant;
use App\Notifications\TaskCompleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

        //        start email notification
        $details = [
            'title' => 'Mail from ParallaxLogic',
            'body' => 'A Product Moved to Inventory from Disable List',
        ];
        $user = Merchant::find(1);
        Mail::to($user)->send(new NotifyMail($details,null, $inventory_product, null));
        $user->notify(new TaskCompleted(null, null, $inventory_product));
//        end email notification

        $logInfo = Inventory::findOrFail($inventory_product->id);
        if (Auth::guard('merchant')->check()) {
            MerchantLogActivity::addToLog('Product Disabled from Inventory!', $logInfo);
        }

        return redirect('/disable-product-index')->with('message', 'Product Disable Successfully');
    }

    public function move($id)
    {

        $disableProduct = DisableProduct::find($id);
        $disableProduct->inventory->status = 1;
        $disableProduct->inventory->save();

        $disableProduct->status = 1;
        $disableProduct->save();

        //        start email notification
        $details = [
            'title' => 'Mail from ParallaxLogic',
            'body' => 'A Product Moved to Inventory from Disable List',
        ];
        $user = Merchant::find(1);
        Mail::to($user)->send(new NotifyMail($details, null, null, $disableProduct));
        $user->notify(new TaskCompleted(null, $disableProduct, null));
//        end email notification

        $logInfo = DisableProduct::findOrFail($disableProduct->id);
        if (Auth::guard('merchant')->check()) {
            MerchantLogActivity::addToLog('Product Enabled Again!', $logInfo);
        }

        return redirect('/inventory')->with('message', 'Product Moved to Inventory Successfully');
    }

}
