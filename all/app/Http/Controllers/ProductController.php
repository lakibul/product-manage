<?php

namespace App\Http\Controllers;

use App\Helpers\AdminLogActivity;
use App\Models\FileManager;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::latest()->paginate(5);
        return view('dashboard.product.manage', $data);
    }

    public function add()
    {
        return view('dashboard.product.add');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'sku' => 'required',
            'short_description' => 'required',
            'price' => 'required',
            'images' => 'required|max:1024',
            'images.*' => 'image|max:1024'
        ]);
        $product = new Product();
        $product->admin_id = !empty(Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : null;
        $product->merch_id = !empty(Auth::guard('merchant')->user()) ? Auth::guard('merchant')->user()->id : null;
        $product->name    = $request->name;
        $product->sku = $request->sku;
        $product->short_description   = $request->short_description;
        $product->long_description  = $request->long_description;
        $product->price  = $request->price;
        $product->save();
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $img) {

                $file_manager = (new FileManager())->upload('product_images', $img);
                foreach ($file_manager as $item){
                    if ($item->id != 0) {
                        $item->origin()->associate($product)->save();
                    }
                }
            }
        }

        $logInfo = Product::findOrFail($product->id);
        if (Auth::guard('admin')->check()){
            AdminLogActivity::addToLog('New Product Created!', $logInfo);
        }

        return redirect('/manage-product')->with('message', 'Product Added successfully');
    }

    public function edit($id)
    {
        $data['product'] = Product::find($id);
        return view('dashboard.product.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'sku' => 'required',
            'short_description' => 'required',
            'price' => 'required',
            'images.*' => 'images|mimes:jpg,jpeg'
        ]);
        $product = Product::find($id);
        $product->name    = $request->name;
        $product->sku = $request->sku;
        $product->short_description   = $request->short_description;
        $product->long_description  = $request->long_description;
        $product->price  = $request->price;
        $product->save();
        if ($request->hasfile('edit_images')) {
            $previous_images = @$product->fileManager;
            foreach ($request->file('edit_images') as $index =>$img) {
                $previous_images[$index]->uploadUpdate('product_images', $img);
            }
        }

        $logInfo = Product::findOrFail($product->id);
        if (Auth::guard('admin')->check()){
            AdminLogActivity::addToLog('Product Updated!', $logInfo);
        }

        return redirect('/manage-product')->with('message', 'Product Updated successfully');
    }

    public function delete($id)
    {
        $this->product = Product::find($id);
        if (file_exists($this->product->image)) {
            unlink($this->product->image);
        }

        $logInfo = Product::findOrFail($id);
        if (Auth::guard('admin')->check()){
            AdminLogActivity::addToLog('Product deleted!', $logInfo);
        }

        $this->product->delete();

        return redirect()->back()->with('message', 'Profile Deleted Successfully');
    }

    public function searchProduct(Request $request)
    {
        $products = Product::Where('name', 'like', '%' . $request->search_string . '%')
            ->orWhere('sku', 'like', '%' . $request->search_string . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);
        if ($products->count() >= 1)
        {
            return view('dashboard.product.pagination', compact('products'))->render();
        }
        else
        {
            return response()->json([
                'status' => 'nothing_found',
            ]);
        }
    }

    public function pagination(Request $request)
    {
        $products = Product::latest()->paginate(5);
        return view('dashboard.product.pagination', compact('products'))->render();
    }

    public function updateStatus($id)
    {
        $message = Product::updateStatus($id);
        return redirect('/manage-product')->with('message', $message);
    }

    public function inventory()
    {
        $products = Product::all();
        return view('dashboard.product.inventory')->with(['products' => $products]);
    }
}
