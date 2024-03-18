<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class UserController extends Controller
{
    public function index() {
        $data = Category::with('product')->get();
        return view('dashboard', compact('data'))->with('title', 'Home');
    }

    public function login() {
        $data['data'] = Category::get();
        return view('login', $data)->with('title', 'Login');
    }

    public function register() {
        return view('register');
    }

    public function category($id) {
        $data['product'] = Category::with('product')->findOrFail($id);
        $data['data'] = Category::get();
        return view('category', $data)->with('title', 'Category');
    }

    public function product($id) {
        $data['data'] = Category::get();
        $data['product'] = Product::findOrFail($id);

        return view('product', $data)->with('title', 'Product');
    }
    
}
