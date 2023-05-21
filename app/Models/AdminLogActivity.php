<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'url', 'method', 'agent', 'admin_id'
    ];

    public function loggable()
    {
        return $this->morphTo(__FUNCTION__,'loggable_type', 'loggable_id');
    }


}
