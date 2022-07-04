<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisableProduct extends Model
{
    use HasFactory;
    protected $fillable = ['merch_id', 'product_id'];
}
