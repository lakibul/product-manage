<?php

namespace App\Http\Controllers;

use App\Helpers\AdminLogActivity;
use App\Helpers\MerchantLogActivity;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function merchantLogActivity()
    {
//        $logs = MerchantLogActivity::logActivityLists();
        $logs = \App\Models\MerchantLogActivity::all();
        return view('dashboard.activity_log.merchant',compact('logs'));
    }

    public function adminLogActivity()
    {
//        $logs = AdminLogActivity::logActivityLists();
        $logs = \App\Models\AdminLogActivity::all();
        return view('dashboard.activity_log.admin',compact('logs'));
    }
}
