<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Other extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_type',
        'origin_id',
        'heading',
        'description',
    ];

    public function origin(): MorphTo
    {
        return $this->morphTo();
    }

    public function fileManager(): MorphMany
    {
        return $this->morphMany(FileManager::class, 'origin');
    }
}
