<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public function edit()
    {
        return view('userdata.edit');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'address' => ['required', 'string', 'max:255'],
            'telephone_number' => ['required', 'alpha_num', 'digits_between:12,14']
        ]);

        User::where('id', auth()->id())->update([
            'address' => $validated['address'],
            'telephone_number' => $validated['telephone_number']
        ]);

        return redirect(route('home'))->with('status', 'alamat dan nomor telephon berhasil diubah');
    }
}