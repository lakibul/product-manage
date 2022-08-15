<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MerchantLogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'url', 'method', 'agent', 'merch_id'
    ];


    public function origin(): MorphTo
    {
        return $this->morphTo();
    }

    public function loggable()
    {
        return $this->morphTo(__FUNCTION__,'loggable_type', 'loggable_id');
    }

}
