<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Confirm;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.manageorder');
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
    public function show(string $invoice)
    {
        $data = Order::with(['user', 'confirm', 'detailOrder.product'])->where('invoice', $invoice)->firstOrFail();

        return view('admin.showorder', compact('data'));
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
        return 'asd';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function confirmPayment(Request $request, string $invoice) {
        try {
            $order = Order::where('invoice', $invoice)->firstOrFail();

            $order->update([
                'status' => 'proses'
            ]);

            return redirect()->back()->with('alert', 'success')->with('message', 'Data updated succesfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', 'error')->with('message', 'Something error...');
        }
        
    }

    public function kirim(Request $request, string $invoice) {
        try {
            $order = Order::where('invoice', $invoice)->firstOrFail();

            $order->update([
                'status' => 'pengiriman'
            ]);

            return redirect()->back()->with('alert', 'success')->with('message', 'Data updated succesfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', 'error')->with('message', 'Something error...');
        }
        
    }

    public function selesaikan(Request $request, string $invoice) {
        try {
            $order = Order::where('invoice', $invoice)->firstOrFail();

            $order->update([
                'status' => 'Done'
            ]);

            return redirect()->route('admin.manageorder.index')->with('alert', 'success')->with('message', 'Data updated succesfully');
        } catch (\Throwable $e) {
            return redirect()->route('admin.manageorder.index')->with('alert', 'error')->with('message', 'Something error...');
        }
        
    }

    public function getOrderData() {
        $data = Order::with('user')->where('status', '!=', 'payment')->where('status', '!=', 'Done')->where('status', '!=', 'cart');
        $index = 0;
        return DataTables::of($data)
        ->addColumn('no', function($data) use ($index) {
           return $index+1;
        })->addColumn('invoice', function($data) {
            return '<a href="'. route("admin.manageorder.show", $data->invoice) .'">'. $data->invoice .'</a>';
         })->addColumn('customer', function($data) {
            return $data->user->name;
         })->addColumn('tanggal', function($data) {
            return $data->updated_at;
         })->addColumn('total', function($data) {
            return $data->total;
         })->addColumn('status', function($data) {
            return $data->status;
         })
         ->rawColumns(['invoice'])
         ->toJson();
    }
}
