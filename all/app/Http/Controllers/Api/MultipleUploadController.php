<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use App\Models\Image;
use App\Models\File;
use Illuminate\Http\Request;
use Image;

class MultipleUploadController extends Controller
{
    public function uploadImage(Request $request)
    {

        $request->validate([
            'filenames' => 'required',
        ]);
        $brand_image = $request->file('filenames');
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(40, 50)->save('image'.$name_gen);
        $final_upload = 'image'.$name_gen;
        File::insert([
           'filenames' => $final_upload,
        ]);
        return response()->json(['file_uploaded'], 200);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'filenames' => 'required',
            'filenames.*' => 'image'
        ]);

        $final_upload = [];
        if($request->hasfile('filenames'))
        {
            foreach($request->file('filenames') as $file)
            {
                $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
                Image::make( $file )->resize( 40, 60 )->save( 'resized-images/' . $filename );
                $final_upload[] = 'image'.$filename;
            }
        }
        $file= new File();
        $file->filenames = json_encode($final_upload);
        $file->save();
        return response()->json(['file_uploaded'], 200);
    }

}
