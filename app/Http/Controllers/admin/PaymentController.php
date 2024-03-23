<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Payment::get();
        return view('admin.payment', compact('data'));
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
    public function store(AdminPaymentRequest $request)
    {
        // dd($request);
        try {
            if(!$request->file('logo')) return redirect()->back()->with('alert', 'info')->with('message', 'The image field is required');
            
            Payment::create([
                'name'  => $request->bankName,
                'norek' => $request->norek,
                'logo'  => $request->file('logo')->store('payments'),
            ]);

            return redirect()->back()->with('alert', 'success')->with('message', 'Data stored successfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('alert', 'error')->with('message', 'Failed to stored data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Payment::findOrFail($id)->delete();

        return redirect()->back()->with('alert', 'success')->with('message', 'Data deleted succesfully');
    }
}
