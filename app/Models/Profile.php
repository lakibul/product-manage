<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        "customer_id", "age", "occupation", "income", "address", "image"
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function others(): MorphMany
    {
        return $this->morphMany(Other::class, 'origin');
    }

    public function fileManager(): MorphMany
    {
        return $this->morphMany(FileManager::class, 'origin');
    }

    public function adminLogs()
    {
        return $this->morphMany(AdminLogActivity::class, 'loggable');
    }

    public function merchantLogs()
    {
        return $this->morphMany(MerchantLogActivity::class, 'loggable');
    }


    private static $profile;
    private static $image;
    private static $imageName;
    private static $imageUrl;
    private static $directory;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = 'profile-images/';
        self::$image->move(self::$directory,self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function newProfile($request)
    {

        self::$profile = new Profile();
        self::$profile->customer_id     = $request->customer_id;
        self::$profile->gender     = $request->gender;
        self::$profile->age    = $request->age;
        self::$profile->occupation = $request->occupation;
        self::$profile->income   = $request->income;
        self::$profile->address  = $request->address;
        self::$profile->image    = self::getImageUrl($request);
        self::$profile->save();
    }


    public static function updateProfile($request, $id)
    {

        self::$profile = Profile::find($id);
        if ($request->file('image'))
        {
            if (file_exists(self::$profile->image))
            {
                unlink(self::$profile->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$profile->image;
        }

        self::$profile->age = $request->age;
        self::$profile->gender = $request->gender;
        self::$profile->occupation = $request->occupation;
        self::$profile->income = $request->income;
        self::$profile->address = $request->address;
        self::$profile->image = self::$imageUrl;
        self::$profile->save();
    }
}
