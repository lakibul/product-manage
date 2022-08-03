<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Customer extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        "admin_id", "merch_id", "name", "mobile"
    ];

    public function customerProfile()
    {
        return $this->hasOne(Profile::class, 'customer_id');
    }

    public function adminLogs()
    {
        return $this->morphMany(AdminLogActivity::class, 'loggable');
    }

    public function merchantLogs()
    {
        return $this->morphMany(MerchantLogActivity::class, 'loggable');
    }
}
