<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request) 
    {
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required',
            'notelp' => 'required|numeric',
            'alamat' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData)->assignRole('member');

        return redirect()->route('login')->with('alert', 'alert-success')->with('message', 'Berhasil registrasi, silahkan Login...');
    }
}
