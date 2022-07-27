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

    public function makeUpload($to, $file): ?string
    {
        try {
            $file_name = time() . Str::uuid();
            $extension = $file->extension();
            $file_name = $file_name . '.' . $extension;

            $path = $to . '/' . $file_name;
            $img = Image::make($file->getRealPath());
            $img->orientate();
            $img->stream();

            Storage::disk(config('app.storage_driver'))->put($path, $img, 'public');

            return $path;
        } catch (Exception $exception) {
            return null;
        }
    }

    public function upload($to, $file): FileManager
    {
        $path = $this->makeUpload($to, $file);
        $file_manager = new self();
        if ($path) {
            $file_manager->url = $path;
            $file_manager->save();
        } else {
            $file_manager->id = 0;
        }
        return $file_manager;
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
