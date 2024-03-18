@extends('layouts.login-layout')

@section('breadcrumb')
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
                <li class="active">Daftar Order</li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
@endsection

@section('main')
<!-- checkout -->
<div class="checkout">
    <div class="container">
        <h2>Kamu memiliki <span>{{ $order->count() }} order</span></h2>
        <div class="checkout-right">
            <table class="timetable_sub">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Invoice</th>
                        <th>Tanggal Order</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $key => $item)
                        <tr class="rem1">
                            <td class="invert">{{ $key+1 }}</td>
                            <td class="invert"><a href="{{ route('order.view', $item->invoice) }}">{{ $item->invoice }}</a></td>
                            <td class="invert">{{ $item->updated_at }}</td>
                            <td class="invert">Rp{{ number_format($item->total) }}</td>

                            <td class="invert">
                                <div class="rem">
                                    @if ($item->status == 'payment')
                                        <a href="{{ route('confirm', $item->invoice) }}">Konfirmasi</a>
                                    @elseif($item->status == 'pending')
                                        Dalam proses verifikasi pembayaran
                                    @endif
                                </div>
                            </td>  
                            @if ($item->status == 'payment')
                            <form action="{{ route('order.destroy', $item->id) }}" method="post" id="delete_{{ $key }}">
                                @csrf
                                @method('DELETE')
                                <td style="border: none"><i class="fa fa-trash text-danger" onclick="$('#delete_{{ $key }}').submit();"></i></td>   
                            </form>  
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- //checkout -->
@endsection