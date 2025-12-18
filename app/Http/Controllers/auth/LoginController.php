<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(auth()->user()->hasRole('admin')) return redirect()->intended('/admin');
            return redirect()->intended('/');
        }

        return back()->with('alert', 'alert-warning')->with('message', 'Username/Password salah');
    }
}
