<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\DetailOrder;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            return redirect()->route('home')->with('alert', 'danger')->with('message', 'Keranjang masih kosong');;
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
        Validator::make($request->all(), [
            'jumlah' => 'required|numeric|min:1',
        ])->validated();
        try {
            DB::transaction(function () use ($request, $id) { 
                $data = DetailOrder::findOrFail($id);
                $order = Order::findOrFail($request->order_id);

                $data->update([
                    'qty' => $request->jumlah,
                    'total' => ($data->total / $data->qty) * $request->jumlah
                ]);

                $total = DetailOrder::where('order_id', $request->order_id)->sum('total');

                $order->update([
                    'total' => $total
                ]);
            });

            return redirect()->back()->with('alert', 'success')->with('message', 'Berhasil mengupdate keranjang...');
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', 'warning')->with('message', 'Something error, try again...');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DetailOrder::findOrFail($id);
        $order = Order::findOrFail($data->order_id);

        $total = $order->total - $data->total;

        if ($total > 0) {
            $order->update([
                'total' => $total
            ]);

            $data->delete();
        } else  {
            $order->delete();
            $data->delete();
            return redirect()->route('home')->with('alert', 'success')->with('message', 'Berhasil menghapus produk dari keranjang');
        }

        return redirect()->back()->with('alert', 'success')->with('message', 'Berhasil menghapus produk dari keranjang');
    }
}
