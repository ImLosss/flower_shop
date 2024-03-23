<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['data'] = DetailOrder::with(['order.user', 'product'])
        ->whereHas('order', function ($query) {
            $query->where('status', 'Done');
        })->get();

        $data['total'] = Order::where('status', 'Done')->sum('total');

        // dd($data);

        return view('admin.laporan', $data);
    }

    public function print() 
    {
        $data['data'] = DetailOrder::with(['order.user', 'product'])
        ->whereHas('order', function ($query) {
            $query->where('status', 'Done');
        })->get();

        $data['total'] = Order::where('status', 'Done')->sum('total');

        // dd($data);

        return view('admin.print', $data);
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
        //
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
        //
    }
}
