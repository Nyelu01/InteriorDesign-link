<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSold;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request){
        $products = Product::orderBy('sold', 'ASC');
        if($request->sort == 'asc'){
            $products =  $products->orderBy('name', 'ASC')->get();
        }else if($request->sort == 'desc'){
            $products =  $products->orderBy('name', 'DESC')->get();
        }else{
            $products =  $products->orderBy('created_at', 'DESC')->orderBy('updated_at', 'DESC')->get();
        }

        return view('vendor.pages.products', compact('products'));
    }

    public function create(){
        return view('vendor.pages.create');
    }

    public function store(Request $request){

        $file = $request->file('image');
        $fileName = 'product_' . time() . '.' . $file->extension();
        $file->move(public_path('assets/img/products'), $fileName);

        Product::create([
            'name' => $request->name,
            'image' => $fileName,
            'description' => $request->description,
            'price' => $request->price,
            'weight' => $request->weight,
            'quantity' => $request->quantity,
            'width' => $request->width,
            'height' => $request->height,
            'sold' => "0",
            'user_id' => Auth::user()->id,
        ]);

        return back()->with('success', 'Congratulations, your product has been successfully created. Wait until your product is sold');
    }

    public function add_to_cart($id){
        $product = Product::findOrFail($id);

        if($product->user_id == Auth::user()->id){
            return back()->with('error', "Purchase failed, you can't buy your own product");
        }

        ProductSold::create([
            'product_id' => $product->id,
            'buyer_id' => Auth::user()->id,
        ]);

        $product->update([
            'sold' => true,
        ]);

        return back()->with('success', 'Congratulations, the product has been purchased successfully');
    }

    public function my(){
        $products = Product::where('user_id', Auth::user()->id)->orderBy('sold', 'asc')->get();
        return view('vendor.pages.my', compact('products'));
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
            Storage::delete('public/img/products' . $product->image);
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
        return redirect()->route('product.my')->with(['message' => 'Product updated successfully!', 'status' => 'success']);
      }


      public function destroy(Product $product) {
        Storage::delete('public/img/products/' . $product->image);
        $product->delete();
        return redirect()->route('product.my')->with(['message' => 'Product deleted successfully!', 'status' => 'info']);
      }



}
