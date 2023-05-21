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
