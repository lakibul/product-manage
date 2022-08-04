<?php

namespace App\Http\Controllers;
use App\Models\AdminLogActivity;
use App\Models\MerchantLogActivity;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function merchantLogActivity()
    {
        $data['logs'] = MerchantLogActivity::latest()->get();
        return view('dashboard.activity_log.merchant', $data);
    }

    public function adminLogActivity()
    {
        $data['logs'] = AdminLogActivity::latest()->get();
        return view('dashboard.activity_log.admin', $data);
    }
}
