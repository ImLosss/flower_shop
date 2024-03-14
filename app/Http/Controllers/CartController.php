<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\DetailOrder;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            Order::where('user_id', Auth::user()->id)->firstOrFail();

            $data['data'] = Category::with('product')->get();
            $data['cart'] = DetailOrder::with('order')->with('product')
            ->whereHas('order', function ($query) {
                $query->where('user_id', Auth::user()->id)->where('status', 'cart');
            })
            ->get();

            // dd($data);

            return view('cart', $data)->with('title', 'Cart');
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', 'danger')->with('message', 'Keranjang masih kosong');;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        try {
            DB::transaction(function () use ($request) { 
                $order = Order::firstOrCreate(
                    ['user_id' => Auth::user()->id, 'status' => 'cart'],
                    ['invoice' => fake()->lexify('INV-??????????')]
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DetailOrder::findOrFail($id)->delete();

        return redirect()->back()->with('alert', 'success')->with('message', 'Berhasil menghapus produk dari keranjang');
    }
}
