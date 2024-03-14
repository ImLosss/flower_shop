<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailOrder;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Order::where('user_id', Auth::user()->id)->where('status', 'cart')->firstOrFail();

        $data['data'] = Category::with('product')->get();
        $data['cart'] = DetailOrder::with('order')->with('product')
        ->whereHas('order', function ($query) {
            $query->where('user_id', Auth::user()->id)->where('status', 'cart');
        })
        ->get();

        return view('checkout', $data)->with('title', 'Checkout');
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
        //
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
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Order::findOrFail($id)->update([
            'status' => 'payment'
        ]);

        return redirect()->route('home')->with('alert', 'success')->with('message', 'Berhasil Checkout, silahkan konfirmasi pembayaran di halaman Daftar Order');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
