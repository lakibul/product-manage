<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FileManager extends Model
{
    use HasFactory;

    public function origin(): MorphTo
    {
        return $this->morphTo();
    }

    public function makeUpload($to, $file): ?array
    {
        try {
            $imgUrl=[];
            $file_name = time() . Str::uuid();
            $extension = $file->extension();
            $file_name = hexdec(uniqid()) . '.' . $extension;
            $file_name2 = hexdec(uniqid()) . '.' . $extension;

            $path = $to . '/' . $file_name;
            $thumbnail = $to . '/' . $file_name2;
            $originalImage = Image::make($file->getRealPath());

            $originalImage->orientate();
            $originalImage->stream();
            Storage::disk(config('app.storage_driver'))->put($path, $originalImage, 'public');
            $imgUrl[] = $path;

            $originalImage->resize(80, 60, function ($constraint) {
                //$constraint->aspectRatio();
            });
            $originalImage->stream();
            Storage::disk(config('app.STORAGE_DRIVER'))->put($thumbnail, $originalImage, 'public');
            $imgUrl[] = $thumbnail;

            return $imgUrl;
        } catch (Exception $exception) {
            return [];
        }
    }

    public function upload($to, $file): array
    {
        $path = $this->makeUpload($to, $file);
        $select=[];
        foreach ($path as $item){
            $file_manager = new self();
            if ($item) {
                $file_manager->url = $item;
                $file_manager->save();
                $select[]=  $file_manager;
            } else {
                $file_manager->id = 0;
                $select[]=  $file_manager;
            }
        }
        return $select;
    }

    public function uploadUpdate($to, $file): FileManager
    {
        $path = $this->makeUpload($to, $file);
        if ($path) {
            $this->remove();

            $this->url = $path;
            $this->save();

            return $this;
        } else {
            $file_manager = new self();
            $file_manager->id = 0;
            return $file_manager;
        }
    }

    public function getUrlAttribute(): ?string
    {
        if (config('app.storage_driver') === 's3') {
            return Storage::disk(config('app.storage_driver'))->url($this->attributes['url']);
        }
        return asset('application/public/storage/' . $this->attributes['url']);
    }

    public function remove()
    {
        Storage::disk(config('app.storage_driver'))->delete($this->attributes['url']);
    }
}
