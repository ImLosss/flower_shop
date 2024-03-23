@extends('layouts.login-layout')

@section('breadcrumb')
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                <li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
                <li class="active">Cart</li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
@endsection

@section('main')
	<!-- checkout -->
	<div class="checkout">
		<div class="container">
			<h1>Terima kasih, {{ Auth::user()->name }} telah membeli {{ $cart->count() }} barang di Flower_Shop</span></h1>
			<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>No.</th>
							<th>Produk</th>
							<th>Nama Produk</th>
							<th>Jumlah</th>
							<th>Sub Total</th>
						</tr>
					</thead>
                    <tbody>
                        @foreach ($cart as $key => $item)
                            <tr class="rem1">
                                <td class="invert">{{ $key+1 }}</td>
                                <td class="invert"><a href="{{ route('product', $item->product_id) }}"><img src="{{ asset('storage/product/image.png') }}" width="100px" height="100px" /></a></td>
                                <td class="invert">{{ $item->product->name }}</td>
                                <td class="invert">
                                    <div class="quantity">
                                        <div class="quantity-select">
                                            <h4>{{ $item->qty }}</h4>
                                        </div>
                                    </div>
                                </td>

                                <td class="invert">Rp{{ number_format($item->total) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
		        </table>
		    </div>
            <div class="checkout-left">
                <div class="checkout-left-basket">
                    <h4>Total Harga yang harus dibayar saat ini</h4>
                    <ul>
                        <h1><input type="text" value="Ongkir (Rp. 10000)" disabled \></h1>
                        <h1><input type="text" value="Rp{{ number_format($item->order->total+10000) }}" disabled \></h1>
                    </ul>
                </div>
                <br>
                <div class="checkout-left-basket" style="width:80%;margin-top:60px;">
                    <div class="checkout-left-basket">
                        <h4>Kode Order Anda</h4>
                        <h1><input type="text" value="{{ $item->order->invoice }}" disabled \></h1>
                    </div>
                </div>

                <div class="clearfix"> </div>
            </div>
            <hr>
            <br>
            <center>
                <h2>Total harga yang tertera di atas sudah termasuk ongkos kirim sebesar Rp10.000</h2>
                <h2>Bila telah melakukan pembayaran, harap konfirmasikan pembayaran Anda.</h2>
                <br>
                @foreach ($payments as $payment)
                    <img src="{{ asset('storage/'.$payment->logo) }}" width="300px" height="200px"><br>
                    <h4>{{ $payment->norek }}<br>
                        a/n. {{ $payment->name }}</h4><br>
                    <br>
                    <hr>
                @endforeach
                <br>
                <br>
                <p>Orderan anda Akan Segera kami proses 1x24 Jam Setelah Anda Melakukan Pembayaran ke ATM kami dan menyertakan informasi pribadi yang melakukan pembayaran seperti Nama Pemilik Rekening / Sumber Dana, Tanggal Pembayaran, Metode Pembayaran dan Jumlah Bayar.</p>
                <br>
                <form action="{{ route('checkout.confirm', $item->order_id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="submit" class="form-control btn btn-success" value="I Agree and Check Out" \>
                </form>
            </center>
	    </div>
	</div>
	<!-- //checkout -->
@endsection