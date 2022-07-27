<?php

namespace App\Http\Controllers;
use App\Models\File;
use App\Models\FileManager;
use App\Models\Other;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('dashboard.image.index');
    }

    public function store(Request $request)
    {
        $file = File::create($request->all());
        if (isset($request->others) && count($request->others ?? []) > 0) {
            foreach ($request->others as $item) {
                $other = Other::create($item);
                if (isset($item['images'])) {

                    foreach ($item['images'] as $img) {

                        $file_manager = (new FileManager())->upload('$file', $img);
                        if ($file_manager->id != 0) {
                            $file_manager->origin()->associate($other)->save();
                        }
                    }
                }
                $other->origin()->associate($file)->save();
            }
        }
    }
}
