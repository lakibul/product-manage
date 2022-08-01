<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FileManager;
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
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg'
        ]);
//        dd($request->all());
        $profile = new Profile();
        $profile->customer_id     = $request->customer_id;
        $profile->gender     = $request->gender;
        $profile->age    = $request->age;
        $profile->occupation = $request->occupation;
        $profile->income   = $request->income;
        $profile->address  = $request->address;
        $profile->save();
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $img) {

                $file_manager = (new FileManager())->upload('profile_images', $img);
                foreach ($file_manager as $item){
                    if ($item->id != 0) {
                        $item->origin()->associate($profile)->save();
                    }
                }

            }
        }
//        Profile::newProfile($request);
        return redirect('/manage-customer')->with('message', 'Profile Added Successfully');
    }

    public function edit($id)
    {
        $data['profile'] = Profile::with(['customer'])->find($id);
        return view('dashboard.profile.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate( [
            'age' => 'required',
            'occupation' => 'required',
            'income' => 'required',
            'address' => 'required',
            'images.*' => 'images|mimes:jpg,jpeg'
        ]);
        $profile = Profile::find($id);
        $profile->age = $request->age;
        $profile->gender = $request->gender;
        $profile->occupation = $request->occupation;
        $profile->income = $request->income;
        $profile->address = $request->address;
        $profile->save();
        if ($request->hasfile('edit_images')) {
            $previous_images = @$profile->fileManager;
            foreach ($request->file('edit_images') as $index =>$img) {
                $previous_images[$index]->uploadUpdate('profile_images', $img);
            }
        }
//        Profile::updateProfile($request, $id);
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
