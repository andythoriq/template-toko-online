<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $isQtyLowerThanStock)
    {
        if($isQtyLowerThanStock == 1) {
          Transaction::where('product_id', $request['product_id'])
            ->where('user_id', auth()->id())
            ->where('telahDiPesan', false)
            ->update(['telahDiPesan' => true]);

            $newStock = $request['product_stock'] - $request['totalOfQty'];

            Product::where('id', $request['product_id'])
                ->update(['stock' => $newStock]);
        } else {
            return redirect(route('cart.index'))->with('error', 'stock tidak cukup');
        }
        
        $user = User::where('id', auth()->id())->first();
        $product = Product::where('id', $request['product_id'])->first();
        $jumlah_pesan = $request['totalOfQty'];
        return view('summary.index', compact('product', 'user', 'jumlah_pesan'));
    }
}