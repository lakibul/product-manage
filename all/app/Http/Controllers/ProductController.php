<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('dashboard.product.manage')->with(['products' => $products]);
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
            'image' => 'required|max:1024',
            'image.*' => 'image|max:1024'
        ]);

        $product = new Product();
        $product->admin_id = !empty(Auth::guard('admin')->user()) ? Auth::guard('admin')->user()->id : null;
        $product->merch_id = !empty(Auth::guard('merchant')->user()) ? Auth::guard('merchant')->user()->id : null;
        $product->name    = $request->name;
        $product->sku = $request->sku;
        $product->short_description   = $request->short_description;
        $product->long_description  = $request->long_description;
        $product->price  = $request->price;
        if($request->hasfile('image'))
        {
            foreach($request->file('image') as $img)
            {
                $name=$img->getClientOriginalName();
                $img->move(public_path().'/product-images/', $name);
                $data[] = $name;
            }
        }
        $product->image = json_encode($data);
        $product->save();
        return redirect('/manage-product')->with('message', 'Product Added successfully');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('dashboard.product.edit')->with(['product' => $product]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'sku' => 'required',
            'short_description' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:1024',
        ]);

        Product::updateProduct($request, $id);
        return redirect('/manage-product')->with('message', 'Product Added successfully');
    }

    public function delete($id)
    {
        $this->product = Product::find($id);
        if (file_exists($this->product->image)) {
            unlink($this->product->image);
        }
        $this->product->delete();

        return redirect('message', 'Profile Deleted Successfully');
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
