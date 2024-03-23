<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $data['pelanggan'] = User::get()->count();
        $data['pesanan'] = Order::where('status', '!=', 'payment')->where('status', '!=', 'cart')->get()->count();
        $data['konfirmasi'] = Order::where('status', 'pending')->get()->count();
        return view('admin.index', $data);
    }
}
