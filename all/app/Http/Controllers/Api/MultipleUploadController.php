<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use App\Models\Image;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
                $img = $file->getClientOriginalName();
                $filename = $img . '-original.' . $file->getClientOriginalExtension();
                $filename2 = $img . '-80x60.' . $file->getClientOriginalExtension();
                $filename3 = $img . '-120x80.' . $file->getClientOriginalExtension();
                $originalImage = Image::make($file);

                $originalImage->stream();
                Storage::disk(config('app.STORAGE_DRIVER'))->put('resized-images/' . $filename, $originalImage);

                $originalImage->resize(80, 60, function ($constraint) {
                    //$constraint->aspectRatio();
                });

                $originalImage->stream();
                Storage::disk(config('app.STORAGE_DRIVER'))->put('resized-images/' . $filename2, $originalImage);

                $originalImage->resize(100, 80, function ($constraint) {
                    //$constraint->aspectRatio();
                });

                $originalImage->stream();
                Storage::disk(config('app.STORAGE_DRIVER'))->put('resized-images/' . $filename3, $originalImage);
            }
        }
        $final_upload[] = $filename;
        return response()->json(['file_uploaded'], 200);
    }

    public function getOriginalUrlAttribute()
    {
        $destinationPath =   $this->folder_name . '/' . $this->file_name;

        if (config('app.STORAGE_DRIVER') === "s3") {
            $s3 = Storage::disk(config('app.STORAGE_DRIVER'));
            return $s3->url($destinationPath);
        }
        return asset('application/public/storage/' . $this->FileDir);
    }

}
