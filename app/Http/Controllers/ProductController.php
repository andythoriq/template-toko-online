<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category'])->orderBy('created_at', 'desc')->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('product.create', compact('categories'));
    }

    public function store(ProductStoreRequest $request)
    {
        $new_product = Product::create($request->validated());

        if($request->hasFile('image')){
            $request->file('image')->move('product-image/', $request->file('image')->getClientOriginalName());
            $new_product->image = $request->file('image')->getClientOriginalName();
            $new_product->save();
        }

        return redirect(route('product.index'))->with('status', 'berhasil menambah data product');
    }

    public function show(Product $product)
    {
        return view('product.detail', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(ProductStoreRequest $request, Product $product)
    {
        // dd($request->validated());
        $product->update($request->validated());

        if($request->hasFile('image')) {
            $request->file('image')->move('product-image/', $request->file('image')->getClientOriginalName());
            $product->update(['image' => $request->file('image')->getClientOriginalName() ]);
        }

        return redirect(route('product.index'))->with('status', 'berhasil mengupdate data product');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('product.index'))->with('status', 'berhasil menghapus data product');
    }
}