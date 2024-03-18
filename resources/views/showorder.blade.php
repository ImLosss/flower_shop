@extends('layouts.login-layout')

@section('breadcrumb')
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
                <li class="active">Order</li>
                <li class="active">{{ $order->invoice }}</li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
@endsection

@section('main')
	<!-- checkout -->
	<div class="checkout">
		<div class="container">
                <h2>{{ $order->invoice }}</span></h2>
                <div class="checkout-right">
                    <table class="timetable_sub">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Produk</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->detailOrder as $key => $item)
                                <tr class="rem1">
                                    <td class="invert">{{ $key+1 }}</td>
                                    <td class="invert"><a href="product.php?idproduk=2"><img src="{{ asset('storage/product/image.png') }}" width="100px" height="100px" /></a></td>
                                    <td class="invert">{{ $item->product->name }}</td>
                                    <td class="invert">
                                        <div class="quantity">
                                            {{ $item->qty }}
                                        </div>
                                    </td>
                                    <td class="invert">Rp{{ number_format($item->product->disc) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            <!--quantity-->
            <div class="checkout-left">
                <div class="checkout-left-basket">
                    <h4>Total Harga</h4>
                    <ul>
                        @foreach ($order->detailOrder as $item)
                            <li>{{$item->product->name}}<i> - </i> <span>Rp{{ number_format($item->total) }} </span></li>
                        @endforeach
                        <li>Ongkir<i> - </i> <span>Rp10,000</span></li>
                        <li><b>Total<i> - </i> <span>Rp{{ number_format($item->order->total+10000) }}</span></b></li>
                    </ul>
                </div>
            </div>
            <div class="checkout-right-basket">
                <a href="{{ route('order') }}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>back</a>
            </div>
        </div>
	</div>
@endsection