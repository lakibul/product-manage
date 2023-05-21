<?php

namespace App\Http\Controllers;

use App\Models\MerchantLogActivity;
use Illuminate\Http\Request;

class LogFilterController extends Controller
{
    public function customer(Request $request)
    {
        if ($request->value == 1){
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'New Customer Created!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
        elseif ($request->value == 2){
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'Customer Updated!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
        else{
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'Customer Deleted!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
    }

    public function profile(Request $request)
    {
        if ($request->value == 1){
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'Customer Profile Created!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
        elseif ($request->value == 2){
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'Customer Profile Updated!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
        else{
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'Customer Profile Deleted!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
    }

    public function product(Request $request)
    {
        if ($request->value == 1){
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'New Product Created!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
        elseif ($request->value == 2){
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'Product Updated!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
        else{
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'Product deleted');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
    }

    public function inventory(Request $request)
    {
        if ($request->value == 1){
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'Product Added to Inventory!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
        else{
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'Product Unit Added!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
    }

    public function disableProduct(Request $request)
    {
        if ($request->value == 1){
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'Product Disabled from Inventory!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
        else{
            $data['logs'] = MerchantLogActivity::query();
            $data['logs'] = $data['logs']->where('description', 'Product Enabled Again!');
            $data['logs'] = $data['logs']->latest()->get();
            return view('dashboard.activity_log.merchant_filter', $data);
        }
    }

}
