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
			<h2>Dalam keranjangmu ada : <span>{{ $cart->count() }} barang</span></h2>
			<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>No.</th>
							<th>Produk</th>
							<th>Nama Produk</th>
							<th>Jumlah</th>
							<th>Harga Satuan</th>
							<th>Hapus</th>
						</tr>
					</thead>
                    <tbody>
                        @foreach ($cart as $key => $item)
                            <tr class="rem1">
                                    <td class="invert">{{ $key+1 }}</td>
                                    <td class="invert"><a href="product.php?idproduk=2"><img src="{{ asset('storage/product/image.png') }}" width="100px" height="100px" /></a></td>
                                    <td class="invert">{{ $item->product->name }}</td>
                                    <td class="invert">
                                        <div class="quantity">
                                            <div class="quantity-select">
                                                <form action="{{ route('updatecart', $item->id) }}" method="post" id="updatecart-{{ $item->id }}">
                                                @csrf
                                                @method('PATCH')
                                                    <input type="number" name="jumlah" class="form-control" height="100px" value="{{ $item->qty }}" \>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="invert">Rp{{ number_format($item->product->disc) }}</td>
                                    <td class="invert">
                                        <input type="button" class="form-control" value="Update" onclick="document.getElementById('updatecart-{{ $item->id }}').submit();">
                                        <input type="button" class="form-control" value="Hapus" onclick="document.getElementById('deletecart-{{ $item->id }}').submit();">

                                        {{-- form delete --}}
                                        <form action="{{ route('deletecart', $item->id) }}" id="deletecart-{{ $item->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
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
                        @foreach ($cart as $item)
                            <li>{{$item->product->name}}<i> - </i> <span>Rp{{ number_format($item->total) }} </span></li>
                        @endforeach
                        <li>Ongkir<i> - </i> <span>Rp10,000</span></li>
                        <li><b>Total<i> - </i> <span>Rp{{ number_format($item->order->total+10000) }}</span></b></li>
                    </ul>
                </div>
                <div class="checkout-right-basket">
                    <a href="index.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
                    <a href="checkout.php"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>Checkout</a>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
	</div>

    <!--quantity-->
    <script>
        $('.value-plus').on('click', function() {
            var divUpd = $(this).parent().find('.value'),
                newVal = parseInt(divUpd.text(), 10) + 1;
            divUpd.text(newVal);
        });

        $('.value-minus').on('click', function() {
            var divUpd = $(this).parent().find('.value'),
                newVal = parseInt(divUpd.text(), 10) - 1;
            if (newVal >= 1) divUpd.text(newVal);
        });

        $(document).ready(function(c) {
            $('.close1').on('click', function(c) {
                $('.rem1').fadeOut('slow', function(c) {
                    $('.rem1').remove();
                });
            });
        });
    </script>
@endsection