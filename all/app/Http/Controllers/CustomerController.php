<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(5);
        return view('dashboard.customer.index')->with(['customers'=>$customers]);
    }
    public function searchProfile(Request $request)
    {
        if ($request->value == 1){
            $hasprofile = Profile::with('customer')->whereHas('customer', function ($q) {
                $q->where('age', 'like', '23');
            })->get();
            return $hasprofile;
        }
        else{
            $hasntProfile = Customer::with('customerProfile')->wheredoesntHave('customerProfile')->get();
            return $hasntProfile;
        }

    }
    public function add()
    {
        return view('dashboard.customer.add');
    }
    public function store(Request $request)
    {

        $request->validate( [
            'name' => 'required',
            'mobile' => 'required|unique:customers|max:255',
        ],[
            'name.required' => 'Name is Required',
            'mobile.required' => 'Phone Number is Required',
        ]);

        $customer = new Customer();
        $customer->admin_id = !empty(Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : null;
        $customer->merch_id = !empty(Auth::guard('merchant')->user()) ? Auth::guard('merchant')->user()->id : null;
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->save();

       return redirect('/manage-customer')->with('message', 'Customer Added Successfully');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('dashboard.customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate( [
            'user_id' => 'required' | 'exists:users,user_id',
            'name' => 'required',
            'mobile' => 'required|max:255',
        ]);

        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->save();

        return redirect('/manage-customer')->with('message', 'Customer updated successfully');
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return back()->with('message', 'Customer Deleted');
    }

    public function pagination(Request $request)
    {
        $customers = Customer::paginate(4);
        return view('dashboard.customer.pagination_products', compact('customers'))->render();
    }

    public function searchCustomer(Request $request)
    {
        $customers = Customer::Where('name', 'like', '%'.$request->search_string.'%')
            ->orderBy('id', 'desc')
            ->paginate(5);
        if ($customers->count() >= 1) {
            return view('dashboard.customer.pagination_products', compact('customers'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found',
            ]);
        }
    }
}
