<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "admin_id", "merch_id", "name", "sku", "short_description", "long_description", "price", "image",
    ];

    public function fileManager(): MorphMany
    {
        return $this->morphMany(FileManager::class, 'origin');
    }

    private static $product;
    private static $image;
    private static $imageName;
    private static $imageUrl;
    private static $directory;
    private static $item;
    private static $message;

    public static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$imageName = self::$image->getClientOriginalName();
        self::$directory = 'product-images/';
        self::$image->move(self::$directory,self::$imageName);
        self::$imageUrl = self::$directory.self::$imageName;
        return self::$imageUrl;
    }

    public static function newProduct($request)
    {

        self::$product = new Product();
        self::$product->admin_id = !empty(Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : null;
        self::$product->merch_id = !empty(Auth::guard('merchant')->user()) ? Auth::guard('merchant')->user()->id : null;
        self::$product->name    = $request->name;
        self::$product->sku = $request->sku;
        self::$product->short_description   = $request->short_description;
        self::$product->long_description  = $request->long_description;
        self::$product->price  = $request->price;
        self::$product->image    = self::getImageUrl($request);
        self::$product->save();
    }
    public static function updateProduct($request, $id)
    {
        self::$product = Product::find($id);
        if ($request->file('image'))
        {
            if (file_exists(self::$product->image))
            {
                unlink(self::$product->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else
        {
            self::$imageUrl = self::$product->image;
        }
        self::$product->name    = $request->name;
        self::$product->sku = $request->sku;
        self::$product->short_description   = $request->short_description;
        self::$product->long_description  = $request->long_description;
        self::$product->price  = $request->price;
        self::$product->image = self::$imageUrl;
        self::$product->save();
    }

    public static function updateStatus($id)
    {
        self::$item = Product::find($id);
        if (self::$item->status == 0)
        {
            self::$item->status = 1;
            self::$message = 'Product Added to Inventory successfully';
        }
        else
        {
            self::$item->status = 0;
            self::$message = 'Product removed from inventory successfully';
        }
        self::$item->save();
        return self::$message;
    }
}
