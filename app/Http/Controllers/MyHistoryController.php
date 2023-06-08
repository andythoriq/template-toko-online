<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MyHistoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $user = User::where('id', auth()->id())->first();
        $transactions = Transaction::with(['product'])
            ->where('user_id', auth()->id())
            ->where('telahDiPesan', true)
            ->get();

        return view('history.index', compact('user', 'transactions'));
    }
}