<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $products = Product::where('user_id', Auth::user()->id)->orderBy('sold', 'asc')->get();
        return view('vendor.pages.index', compact('products'));
    }


    public function create(){
        return view('vendor.pages.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'price' => 'required|numeric',
        'weight' => 'required|numeric',
        'quantity' => 'required|integer',
        'width' => 'required|numeric',
        'height' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $file = $request->file('image');
    $fileName = 'product_' . time() . '.' . $file->getClientOriginalExtension();
    $file->storeAs('public/img/products', $fileName);

    Product::create([
        'name' => $request->name,
        'image' => $fileName,
        'description' => $request->description,
        'price' => $request->price,
        'weight' => $request->weight,
        'quantity' => $request->quantity,
        'width' => $request->width,
        'height' => $request->height,
        'sold' => false,
        'user_id' => Auth::id(),
    ]);

    return redirect()->route('product.index')->with('success', 'Congratulations, your product has been successfully created. Wait until your product is sold');
}


    public function edit(Product $product) {
        return view('vendor.pages.edit', ['product' => $product]);
      }


      public function update(Request $request, Product $product) {
        $fileName = '';
        if ($request->hasFile('image')) {
            $fileName = 'product_' . time() . '.' . $request->file('image')->extension();
            $request->image->storeAs('public/img/products', $fileName);
            if ($product->image) {
                Storage::delete('public/img/products/' . $product->image);
            }
        } else {
            $fileName = $product->image;
        }

        $productData = [
            'name' => $request->name,
            'image' => $fileName,
            'description' => $request->description,
            'price' => $request->price,
            'weight' => $request->weight,
            'quantity' => $request->quantity,
            'width' => $request->width,
            'height' => $request->height,
        ];

        $product->update($productData);
        return redirect()->route('product.index')->with(['message' => 'Product updated successfully!', 'status' => 'success']);
    }



      public function destroy(Product $product) {
        Storage::delete('public/img/products/' . $product->image);
        $product->delete();
        return redirect()->route('product.index')->with(['message' => 'Product deleted successfully!', 'status' => 'info']);
      }



}
