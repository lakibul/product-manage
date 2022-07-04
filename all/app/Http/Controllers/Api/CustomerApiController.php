<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CustomerApiController extends Controller
{
    public function showCustomer($id=null)
    {
        if ($id==''){
            $customers = Customer::get();
            return response()->json(['customers'=>$customers], 200);
        }else{
            $customers = Customer::find($id);
            return response()->json(['customers'=>$customers], 200);
        }
    }

    public function addCustomer(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
//            return $data;

            $rules = [
                'name' => 'required',
                'mobile' => 'required|unique:customers|max:255',
            ];
            $customMessage = [
                'name.required' => 'Name is Required',
                'mobile.required' => 'Phone Number is Required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);
            if ($validator->fails()){
                return response()->json($validator->errors(), 422);
            }

            $customer = new Customer();
            $customer->admin_id = !empty(Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : null;
            $customer->merch_id = !empty(Auth::guard('api')->user()) ? Auth::guard('api')->user()->id : null;
            $customer->name = $request->name;
            $customer->mobile = $request->mobile;
            $customer->save();
            $message = 'Customer Successfully Added';
            return response()->json(['message'=>$message], 201);

        }
    }


    public function addMultipleCustomer(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
//            return $data;

            $rules = [
                'customers.*.name' => 'required',
                'customers.*.mobile' => 'required|unique:customers|max:255',
            ];
            $customMessage = [
                'customers.*.name.required' => 'Name is Required',
                'customers.*.mobile.required' => 'Phone Number is Required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);
            if ($validator->fails()){
                return response()->json($validator->errors(), 422);
            }

            foreach ($data['customers'] as $addcustomer){
                $customer = new Customer();
                $customer->admin_id = !empty(Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : null;
                $customer->merch_id = !empty(Auth::guard('api')->user()) ? Auth::guard('api')->user()->id : null;
                $customer->name = $addcustomer['name'];
                $customer->mobile = $addcustomer['mobile'];
                $customer->save();
                $message = 'Customer Successfully Added';
            }
            return response()->json(['message'=>$message], 201);

        }
    }


    public function updateCustomer(Request $request, $id)
    {
        if ($request->isMethod('put')){
            $data = $request->all();
//            return $data;

            $rules = [
                'name' => 'required',
                'mobile' => 'required|unique:customers|max:255',
            ];
            $customMessage = [
                'name.required' => 'Name is Required',
                'mobile.required' => 'Phone Number is Required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);
            if ($validator->fails()){
                return response()->json($validator->errors(), 422);
            }

            $customer = Customer::find($id);
            $customer->admin_id = !empty(Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : null;
            $customer->merch_id = !empty(Auth::guard('api')->user()) ? Auth::guard('api')->user()->id : null;
            $customer->name = $data['name'];
            $customer->mobile = $data['mobile'];
            $customer->save();
            $message = 'Customer Successfully Updated';
            return response()->json(['message'=>$message], 201);

        }
    }


    public function deleteCustomer($id=null)
    {
        Customer::findorFail($id)->delete();
        $message = 'Customer Successfully deleted';
        return response()->json(['message'=>$message], 201);
    }
}
