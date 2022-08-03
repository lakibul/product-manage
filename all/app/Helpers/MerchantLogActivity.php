<?php


namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Models\MerchantLogActivity as MerchantLogActivityModel;


class MerchantLogActivity
{

    public static function addToLog($subject, $customerLog, $request)
    {
        $customerLog->adminLogs()->create([
            'description' => $subject,
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'agent' => $request->header('user-agent'),
            'merch_id' => !empty(Auth::guard('admin')->user()) ? Auth::guard('merchant')->user()->id : null,
        ]);
//        $log = [];
//        $log['description'] = $subject;
//        $log['url'] = Request::fullUrl();
//        $log['method'] = Request::method();
//        $log['agent'] = Request::header('user-agent');
//        $log['user_id'] = !empty(Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : null;
//        AdminLogActivityModel::create($log);

    }


    public static function logActivityLists()
    {
        return MerchantLogActivityModel::latest()->get();
    }

}


