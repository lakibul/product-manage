<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantLogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'url', 'method', 'agent', 'merch_id'
    ];

    public function loggable()
    {
        return $this->morphTo(__FUNCTION__,'loggable_type', 'loggable_id');
    }

}
