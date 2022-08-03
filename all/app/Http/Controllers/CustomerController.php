<?php

namespace App\Http\Controllers;

use App\Helpers\AdminLogActivity;
use App\Helpers\MerchantLogActivity;
use App\Models\Customer;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $data['customers'] = Customer::with('customerProfile')->paginate(5);
        return view('dashboard.customer.index', $data);
    }
    public function searchProfile(Request $request)
    {
        if ($request->value == 1){
            $data['hasProfile'] = Profile::with('customer')->whereHas('customer')->get();
            return view('dashboard.check-profile.show', $data);
        }
        else{
            $data['hasNotProfile'] = Customer::with('customerProfile')->wheredoesntHave('customerProfile')->get();
            return view('dashboard.check-profile.show', $data);
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

        $customerLog = Customer::find($customer->id);
        if (Auth::guard('admin')->check()){
            AdminLogActivity::addToLog('New Customer Created!', $customerLog, $request);
        }
        else{
            MerchantLogActivity::addToLog('New Customer Created!', $customerLog, $request);
        }

//        $cuslog->adminLogs()->create([
//
//        ]);
//        $cuslog->adminLogs()->create([
//            'description' => 'Customer Created again!!',
//        'url' => $request->fullUrl(),
//        'method' => $request->method(),
//        'agent' => $request->header('user-agent'),
//        'admin_id' => !empty(Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : null,
//        ]);
//        dd($cuslog);

//        $adminLog = new \App\Models\AdminLogActivity();
//        $adminLog->description = 'Customer Created again!!';
//        $adminLog->url = $request->fullUrl();
//        $adminLog->method = $request->method();
//        $adminLog->agent = $request->header('user-agent');
//        $adminLog->admin_id = !empty(Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : null;
//       $adminLog->save();



       return redirect('/manage-customer')->with('message', 'Customer Added Successfully');
    }

    public function edit($id)
    {
        $data['customer'] = Customer::find($id);
        return view('dashboard.customer.edit', $data);
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
        $data['customers'] = Customer::with('customerProfile')->paginate(4);
        return view('dashboard.customer.pagination_products', $data)->render();
    }

    public function searchCustomer(Request $request)
    {
        $customers = Customer::Where('name', 'like', '%'.$request->search_string.'%')
            ->orderBy('id', 'asc')
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
