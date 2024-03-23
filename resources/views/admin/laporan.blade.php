@extends('layouts.admin')

@section('content')   
<div class="main-content-inner">     
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h2>Laporan</h2>
                    </div>
                    <div class="data-tables datatable-dark">
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
                                @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center p-4 text-muted"><h4>Data kosong</h4></td>
                                    </tr>
                                @else
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
                            @endif
                        </table>
                    </div>
                        <a href="{{ $data->isEmpty() ? '' : route('admin.laporan.print') }}" class="btn btn-info">Export Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection