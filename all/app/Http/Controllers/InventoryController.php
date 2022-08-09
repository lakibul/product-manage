<?php

namespace App\Http\Controllers;

use App\Helpers\MerchantLogActivity;
use App\Mail\NotifyMail;
use App\Models\Inventory;
use App\Models\Merchant;
use App\Models\Product;
use App\Notifications\TaskCompleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class InventoryController extends Controller
{
    public function index()
    {
        $data['inventories'] = Inventory::with('products')->latest()->get();
        return view('dashboard.inventory.index', $data);
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

        //        start email notification
        $details = [
            'title' => 'Mail from ParallaxLogic',
            'body' => 'A Product added to Inventory',
        ];
        $user = Merchant::find(1);
        Mail::to($user)->send(new NotifyMail($details, $product, null, null));
        $user->notify(new TaskCompleted($product));
//        Notification::send($user, new EmailNotification());
//        end email notification

        $logInfo = Product::findOrFail($product->id);
        if (Auth::guard('merchant')->check()) {
            MerchantLogActivity::addToLog('Product Added to Inventory!', $logInfo);
        }

        return back()->with('message', 'Product Added to Inventory successfully');
    }

    public function addUnit(Request $request, $id)
    {
        $request->validate([
           'unit' => 'required'
        ]);

        $inventory = Inventory::find($id);
        $inventory->unit = $request->unit;
        $inventory->save();

        $logInfo = Inventory::findOrFail($inventory->id);
        if (Auth::guard('merchant')->check()) {
            MerchantLogActivity::addToLog('Product Unit Added!', $logInfo);
        }
        return redirect()->back()->with('message', 'Product Quantity added successfully');
    }
}
