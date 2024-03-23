@extends('layouts.print-layout')

@section('content')
    <h1 class="text-center mt-4">Laporan</h1>
    <div class="data-tables datatable-dark mt-5 mr-5 ml-5">
        <table id="dataTable3" class="display" style="width:100%">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Invoice</th>
                    <th>Nama Customer</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal Order</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->order->invoice }}</td>
                        <td>{{ $item->order->user->name }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp{{ $item->total }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>{{ $item->order->status }}</td>
                    </tr>	
                @endforeach
            </tbody>
            <tr>
                <td colspan="5" class="text-center"><b>TOTAL</b></td>
                <td><b>Rp{{ number_format($total) }}</b></td>
            </tr>
        </table>
        <footer>
            <div class="footer-area">
                <p>By Flower_Shop</p>
            </div>
        </footer>
    </div>
	
    <!-- jquery latest version -->
    <script src="{{asset('assets/js/vendor/jquery-2.2.4.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#dataTable3')) {
                $('#dataTable3').DataTable().destroy();
            }
            
            $('#dataTable3').DataTable({
                paging: false,
                searching: false
            });
        });
        // Pemanggilan window.print() akan melakukan pencetakan saat halaman dimuat
        window.onload = function() {
            window.print();
        }

        // Deteksi ketika pencetakan dibatalkan (dalam beberapa kasus)
        window.onafterprint = function() {
            // Kembali ke halaman sebelumnya jika pencetakan dibatalkan
            window.location.href = document.referrer;
        }
    </script>

@endsection
