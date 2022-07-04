<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Validator;
use Image;
use File;

class ProfileApiController extends Controller
{
    public function showProfile($id=null)
    {
        if ($id==''){
            $profiles = Profile::get();
            return response()->json(['profiles'=>$profiles], 200);
        }else{
            $profiles = Profile::find($id);
            return response()->json(['customers'=>$profiles], 200);
        }
    }

    public function store(Request $request)
    {
            $rules = [
                'customer_id' => 'required',
                'age' => 'required',
                'occupation' => 'required',
                'income' => 'required',
                'address' => 'required',
                'image' => 'required',
                'image.*' => 'image'
            ];

            $files = [];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return response()->json($validator->errors(), 422);
            }

            $profile = new Profile();
            $profile->customer_id     = $request->customer_id;
            $profile->age    = $request->age;
            $profile->occupation = $request->occupation;
            $profile->income   = $request->income;
            $profile->address  = $request->address;
            if($request->hasfile('image'))
            {
                foreach($request->file('image') as $file)
                {
                    $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                    Image::make( $file )->resize( 40, 60 )->save( 'profile-images/' . $filename );
                    $files[] = 'image'.$filename;
                }
            }
            $profile->image = json_encode($files);
            $profile->save();
            $message = 'Profile Successfully Added';
            return response()->json(['message'=>$message], 201);
    }

//    public function updateProfile(Request $request, $id)
//    {
//        $profile = Profile::find($id);
//        $profile->age    = isset($request->age) ? $request->age : $profile->age;
//        $profile->occupation =  isset($request->occupation) ? $request->occupation : $profile->occupation;
//        $profile->income   =  isset($request->income) ? $request->income : $profile->income;
//        $profile->address  =  isset($request->address) ? $request->address : $profile->address;
//        if ($request->image && $request->image->isValid())
//        {
//            $file_name = time().'.'.$request->image->extension();
//            $request->image->move(public_path('image'),$file_name);
//            $path = "public/profile-images/$file_name";
//            $profile->image = $path;
//        }
//        $profile->save();
//        $message = 'Profile Successfully Updated';
//        return response()->json(['message'=>$message], 201);
//    }

    public function updateProfile(Request $request, $id)
    {
        $found = Profile::find($id);
        if (!$found) {
            return response()->json(['message' => 'Id not found'], 404);
        }
        $validatedData = Validator::make($request->all(), [
            'age' => 'sometimes',
            'occupation' => 'sometimes',
            'income' => 'sometimes',
            'address' => 'sometimes',
            'image' => 'sometimes|mimes:jpg,png,jpeg|max:1024',
        ]);
        $files = [];
        if ($validatedData->fails()) {
            return response()->json(['success' => false, 'message' => $validatedData->errors()], 400);
        }

        if ($request->hasFile('image')) {
//            $logo = $request->image;
//            $fileName = date('Y') . $logo->getClientOriginalName();
//            $path = $request->image->storeAs('image', $fileName, 'public');
            foreach($request->file('image') as $file)
            {
                $filename = hexdec(uniqid()) . $file->getClientOriginalName();
                $path = Image::make( $file )->resize( 40, 60 )->save( 'profile-images/' . $filename );
//                $files[] = 'image'.$filename;
                $found['image'] = $path;
            }
        }


        $found->update($request->except('image'));

        return response()->json(['success' => true, 'message' => 'Profile updated successfully!',
            'updated_data' => $found], 200);
    }

    public function deleteProfile($id=null)
    {
        Profile::findorFail($id)->delete();
        $message = 'Profile Successfully deleted';
        return response()->json(['message'=>$message], 201);
    }
}
