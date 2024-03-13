<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        $data = Category::with('product')->get();
        return view('dashboard', compact('data'));
    }

    public function login() {
        $data['data'] = Category::get();
        return view('login', $data);
    }

    public function register() {
        return view('register');
    }

    public function category($id) {
        $data['product'] = Category::with('product')->findOrFail($id);
        $data['data'] = Category::get();
        return view('category', $data);
    }

    public function product($id) {
        $data['data'] = Category::get();
        $data['product'] = Product::findOrFail($id);

        return view('product', $data);
    }

    public function addcart(Request $request) {
        // dd($request);
        try {
            DB::transaction(function () use ($request) {
                $orderId = Order::firstOrCreate(
                    ['user_id' => Auth::user()->id, 'status' => 'cart']
                );

                $detailOrder = DetailOrder::firstOrCreate(
                    ['order_id' => $orderId->id, 'product_id' => $request->product_id],
                    ['total' => $request->price] 
                );

                $detailOrder->update([
                    'qty' => $detailOrder->qty+1,
                    'total' => ($detailOrder->qty+1)*$request->price
                ]);
            });
        } catch (\Throwable $e) {
            return 'asdad';
        }
    }
    
}
