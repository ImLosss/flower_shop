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
<!-- konfirmasi -->
<div class="register">
    <div class="container">
        <h2>Konfirmasi</h2>
        <div class="login-form-grids">
            <h3>Invoice</h3>
            <form method="post" action="{{ route('order.storepayment') }}" enctype="multipart/form-data">
                @csrf
                <strong>
                    <input type="text" name="invoice" value="{{ $order->invoice }}" disabled>
                    <input type="hidden" name="invoice" value="{{ $order->invoice }}">
                </strong>
                <h6>Informasi Pembayaran</h6>
                <input type="text" name="name" placeholder="Nama Pemilik Rekening / Sumber Dana" required>
                <br>
                <h6>Rekening Tujuan</h6>
                <select name="payment_id" class="form-control">
                    @foreach ($payments as $payment)
                        <option value="{{ $payment->id }}">{{ $payment->name }} | {{ $payment->norek }}</option>
                    @endforeach
                </select>
                <br>
                <h6>Tanggal Bayar</h6>
                <input type="date" class="form-control" name="date" required>
                <h6>Bukti transaksi</h6>
                <input type="file" name="buktiTransaksi" placeholder="Masukkan bukti transaksi disini" required>
                @error('buktiTransaksi')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <input type="submit" value="Kirim">
            </form>
        </div>
        <div class="register-home">
            <a href="index.php">Batal</a>
        </div>
    </div>
</div>
<!-- //konfirmasi -->
@endsection