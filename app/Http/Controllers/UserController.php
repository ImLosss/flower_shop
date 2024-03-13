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

    public function addcart(Request $request) {
        // dd($request);
        try {
            DB::transaction(function () use ($request) { 
                $order = Order::firstOrCreate(
                    ['user_id' => Auth::user()->id, 'status' => 'cart']
                );

                $detailOrder = DetailOrder::firstOrCreate(
                    ['order_id' => $order->id, 'product_id' => $request->product_id],
                    ['total' => $request->price] 
                );

                $detailOrder->update([
                    'qty' => $detailOrder->qty+1,
                    'total' => ($detailOrder->qty+1)*$request->price
                ]);

                $totalQty = DetailOrder::where('order_id', $order->id)->sum('total');

                $order->update([
                    'total' => $totalQty
                ]);
            });

            return redirect()->back()->with('alert', 'success')->with('message', 'Berhasil memasukkan ke keranjang...');
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', 'warning')->with('message', 'Something error, try again...');
        }
    }

    public function showcart() {
        Order::where('user_id', Auth::user()->id)->firstOrFail();

        $data['data'] = Category::with('product')->get();
        $data['cart'] = DetailOrder::with('order')->with('product')
        ->whereHas('order', function ($query) {
            $query->where('user_id', Auth::user()->id)->where('status', 'cart');
        })
        ->get();

        // dd($data);

        return view('cart', $data)->with('title', 'Cart');
    }

    public function deletecart(string $id) { 
        DetailOrder::findOrFail($id)->delete();

        return redirect()->back()->with('alert', 'success')->with('message', 'Berhasil menghapus produk dari keranjang');
    }

    public function updatecart(string $id) { 
        dd($id);
    }
    
}
