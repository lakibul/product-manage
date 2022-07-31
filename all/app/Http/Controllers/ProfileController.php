<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Profile;
use Illuminate\Http\Request;
use PhpParser\Builder;
use function GuzzleHttp\Promise\all;

class ProfileController extends Controller
{
    public function add($id)
    {
        $customer = Customer::find($id);
        return view('dashboard.profile.add')->with(['customer'=>$customer]);
    }

    public function index($id)
    {
        $data['person'] = Customer::with('customerProfile')->get()->find($id);
        return view('dashboard.profile.manage', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'occupation' => 'required',
            'income' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,jpeg,png|required|max:1024',
        ]);
        Profile::newProfile($request);
        return redirect('/manage-customer')->with('message', 'Profile Added Successfully');
    }

    public function edit($id)
    {
        $profile = Profile::with(['customer'])->find($id);
        return view('dashboard.profile.edit')->with(['profile'=>$profile]);
    }

    public function update(Request $request, $id)
    {
        $request->validate( [
            'age' => 'required',
            'occupation' => 'required',
            'income' => 'required',
            'address' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:1024',
        ]);

        Profile::updateProfile($request, $id);
        return redirect()->route('customer.manage')->with('message', 'Profile Updated Successfully');
    }

    public function delete($id)
    {
        $this->profile = Profile::find($id);
        if (file_exists($this->profile->image))
        {
            unlink($this->profile->image);
        }
        $this->profile->delete();

        return redirect('/manage-customer')->with('message', 'Profile Deleted Successfully');
    }

}
