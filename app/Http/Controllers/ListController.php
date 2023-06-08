<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function product_detail() {
        return;
    }

    public function getProductByCategory(Request $request) {
        if (empty($request['id'])) {
            return redirect(route('home'));
        }
        $request->validate(['id' => 'required|exists:categories,id']);
        $products = Product::with('category:id,name')->where('category_id', $request['id'])->get();
        $categories = Category::all(['id', 'name']);
        return view('home', compact('categories', 'products'));
    }
}