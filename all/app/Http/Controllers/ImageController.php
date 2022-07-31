<?php

namespace App\Http\Controllers;
use App\Models\File;
use App\Models\FileManager;
use App\Models\Other;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ImageController extends Controller
{
    public function index()
    {
        $data['images'] = FileManager::all();
        return view('dashboard.image.index', $data);
    }

    public function storeImages(Request $request){

        $image = new File();
        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $file)
            {
                $img = $file->getClientOriginalName();
                $filename = $img . '-original.' . $file->getClientOriginalExtension();
                $filename2 = $img . '-80x60.' . $file->getClientOriginalExtension();
                $filename3 = $img . '-120x80.' . $file->getClientOriginalExtension();
                $originalImage = Image::make($file);

                $originalImage->stream();
                $imgPath1 ='resized-images/' . $filename;
                $imgPath2 ='resized-images/' . $filename2;
                $imgPath3 ='resized-images/' . $filename3;
                //dd(storage_path() . '/' . $imgPath);
                Storage::disk(config('app.STORAGE_DRIVER'))->put($imgPath1, $originalImage);

                $originalImage->resize(80, 60, function ($constraint) {
                    //$constraint->aspectRatio();
                });

                $originalImage->stream();
                Storage::disk(config('app.STORAGE_DRIVER'))->put($imgPath2, $originalImage);


                $originalImage->resize(100, 80, function ($constraint) {
                    //$constraint->aspectRatio();
                });

                $originalImage->stream();
                Storage::disk(config('app.STORAGE_DRIVER'))->put($imgPath3, $originalImage);

            }
            $imgUrl1 = storage_path() . '/' . $imgPath1;
            $imgUrl2 = storage_path() . '/' . $imgPath2;
            $imgUrl3 = storage_path() . '/' . $imgPath3;
            $image->filenames = $imgUrl1.$imgUrl2.$imgUrl3;
            $image->save();
        }
        return redirect()->back()->with('message', 'Image Added Successfully');
    }

    public function store(Request $request)
    {
        $file = File::create();
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $img) {

                $file_manager = (new FileManager())->upload('test_files', $img);
                foreach ($file_manager as $item){
                    if ($item->id != 0) {
                        $item->origin()->associate($file)->save();
                    }
                }

            }
        }
        return redirect()->back()->with('message', 'Product Added Successfully');
    }

}
