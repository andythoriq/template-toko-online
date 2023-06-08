<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request, $product_id) {
        $request['user_id'] = auth()->id();
        $request['product_id'] = $product_id;
        $stock = $request['product_stock'];
        $request->validate(['qty' => ['required', 'integer', 'min:1', "max:$stock"]]);
        
        Transaction::create($request->all());
        return redirect(route('home'))->with('status', 'berhasil menambah data ke keranjang');
    }

    public function index() {
        $carts = Transaction::with(['product'])
            ->select('product_id')
            ->distinct()
            ->where('user_id', auth()->id())
            ->where('telahDiPesan', false)
            ->get();

        return view('cart.index', compact('carts'));
    }

    public function show($product_id) {
        $product = Product::where('id', $product_id)->first();
        $carts = Transaction::with(['product'])
        ->where('product_id', $product_id)
        ->where('user_id', auth()->id())
        ->where('telahDiPesan', false)
        ->get();

        return view('cart.show', compact('carts', 'product'));
    }

    public function destroy($transaction_id) {
        Transaction::destroy($transaction_id);

        return redirect()->back()->with('status', 'berhasil hapus data');
    }
}