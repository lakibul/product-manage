<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'filenames',
    ];

    public function others(): MorphMany
    {
        return $this->morphMany(Other::class, 'origin');
    }

    public function fileManager(): MorphMany
    {
        return $this->morphMany(FileManager::class, 'origin');
    }
}
