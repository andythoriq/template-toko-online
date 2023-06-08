<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Transaction::with(['user'])
            ->select('user_id')
            ->distinct()
            ->where('telahDiPesan', true)->get();

            // dd($orders);
        return view('order.index', compact('orders'));
    }

    public function show($user_id) {
        $user = User::where('id', $user_id)->first();
        $orders = Transaction::with(['product'])
            ->where('user_id', $user_id)
            ->where('telahDiPesan', true)->get();

        return view('order.show', compact('orders', 'user'));
    }
}