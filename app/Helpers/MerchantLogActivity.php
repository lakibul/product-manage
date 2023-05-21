<?php


namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Models\MerchantLogActivity as MerchantLogActivityModel;


class MerchantLogActivity
{

    public static function addToLog($subject, $logInfo)
    {
        $logInfo->merchantLogs()->updateOrCreate([
            'description' => $subject,
            'url' => Request::fullUrl(),
            'method' => Request::method(),
            'agent' => Request::header('user-agent'),
            'merch_id' => Auth::guard('merchant')->user()->id,
        ]);
    }


    public static function logActivityLists()
    {
        return MerchantLogActivityModel::latest()->get();
    }

}


