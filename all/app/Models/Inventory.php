<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = ['merch_id', 'product_id'];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
