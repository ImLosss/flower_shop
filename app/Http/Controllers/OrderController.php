<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Confirm;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            Order::where('user_id', Auth::user()->id)->firstOrFail();

            $data['order'] =  Order::where('user_id', Auth::user()->id)->get();
            $data['data'] = Category::with('product')->get();

            // dd($data);

            return view('order', $data)->with('title', 'List Order');
        } catch (\Throwable $e) {
            return redirect()->route('home')->with('alert', 'danger')->with('message', 'Belum memesan atau order masih kosong');
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
    public function store(PaymentRequest $request)
    {
        $order = Order::where('invoice', $request->invoice)->firstOrFail();

        // $gallery = new Gallery();
        // $gallery->image = $nama_image;
        // $gallery->save();
        DB::transaction(function () use ($request, $order) {

            $random = strtoupper (Str::random($length = 7));
 
            $image = $request->file('buktiTransaksi');
            $nama_image   = 'gallery_'.$random.'.'.$image->getClientOriginalExtension();
            $request->file('buktiTransaksi')->move('image_uploads', $nama_image);
            
            Confirm::create([
                'order_id'            => $order->id,
                'user_id'             => Auth::user()->id,
                'payment_id'          => $request->payment_id,
                'sender_account_name' => $request->name,
                'proof_of_payment'    => $nama_image,
            ]);

            $order->update([
                'status'     => 'pending',
                'payment_id' => $request->payment_id
            ]);

        });

        return redirect()->route('order')->with('alert', 'success')->with('message', 'Berhasil mengupload bukti transaksi, admin akan segera memproses pesanan anda...');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $inv)
    {
        $data['data'] = Category::with('product')->get();
        $data['order'] = Order::with('detailOrder')->where('invoice', $inv)->firstOrFail();

        // dd($data);

        return view('showorder', $data)->with('title', 'Checkout');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $inv)
    {
        $data['data'] = Category::with('product')->get();
        $data['order'] = Order::with('detailOrder')->where('status', 'payment')->where('invoice', $inv)->firstOrFail();
        $data['payments'] = Payment::get();

        // dd($data);

        return view('confirm', $data)->with('title', 'Confirm');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd($id);
    }
}
