<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Auth;
use Validator;

class MerchantApiController extends Controller
{
    public function register(Request $request)
    {
        if ($request->isMethod('post')){
            $data = $request->all();
//            return $data;

            $rules = [
                'name' => 'required',
                'email' => 'required|unique:merchants|max:255',
                'password' => 'required'
            ];
            $customMessage = [
                'name.required' => 'Name is Required',
                'email.required' => 'Email is Required',
                'email.email' => 'Email must be valid',
                'password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);
            if ($validator->fails()){
                return response()->json($validator->errors(), 422);
            }

            $merchant = new Merchant();
            $merchant->name = $data['name'];
            $merchant->email = $data['email'];
            $merchant->password = bcrypt($data['password']);
            $merchant->access_token = $merchant->createToken($data['email'])->accessToken;
            $merchant->save();

            $message = 'New Merchant Successfully Added';
            return response()->json(['message'=>$message], 201);

//            if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
//                $merchant = Merchant::where('email',$data['email'])->first();
//                $access_token = $merchant->createToken($data['email'])->accessToken;
//                Merchant::where('email',$data['email'])->update(['access_token'=>$access_token]);
//                $message = 'New Merchant Successfully Added';
//                return response()->json(['message'=>$message, 'access_token'=>$access_token], 201);
//
//            }else{
//                $message = 'OPPS! Something went wrong';
//                return response()->json(['message'=>$message],422);
//            }

        }
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')){
            $data = $request->all();
//            return $data;

            $rules = [
                'email' => 'required|exists:merchants|max:255',
                'password' => 'required'
            ];
            $customMessage = [
                'email.required' => 'Email is Required',
                'email.email' => 'Email must be valid',
                'email.exists' => 'Email does not exists',
                'password.required' => 'Password is required',
            ];

            $validator = Validator::make($data, $rules, $customMessage);
            if ($validator->fails()){
                return response()->json($validator->errors(), 422);
            }

            if (Auth::guard('merchant')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                $merchant = Merchant::where('email',$data['email'])->first();
                $access_token = $merchant->createToken($data['email'])->accessToken;
                Merchant::where('email',$data['email'])->update(['access_token'=>$access_token]);
                $message = 'New Merchant Successfully Logged in';
                return response()->json(['message'=>$message, 'access_token'=>$access_token], 201);

            }else{
                $message = 'Invalid Email or Password!';
                return response()->json(['message'=>$message],422);
            }

        }
    }

    public function profile()
    {
        $id = Auth::guard('api')->user();

        return response()->json([
            "status" => true,
            "message" => "User data",
            "data" => $id
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            "status"=>"true",
            "message"=>"Merchant logged out successfully"
        ]);
    }
}
