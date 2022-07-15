<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Profile;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.home');
//        $hasProfile = Profile::Has('customer')->get();
//        $hasntProfile = Customer::doesntHave('customerProfile')->get();
//        return $hasProfile;
    }

    public function test()
    {
        //final test 
    }
}
