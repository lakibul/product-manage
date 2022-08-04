<?php


namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Models\AdminLogActivity as AdminLogActivityModel;


class AdminLogActivity
{
    public static function addToLog($subject, $logInfo)
    {
        $logInfo->adminLogs()->updateOrCreate([
            'description' => $subject,
        'url' => Request::fullUrl(),
        'method' => Request::method(),
        'agent' => Request::header('user-agent'),
        'admin_id' => Auth::guard('admin')->user()->id,
        ]);
    }

    public static function logActivityLists()
    {
        return AdminLogActivityModel::latest()->get();
    }


}
