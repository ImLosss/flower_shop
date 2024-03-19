@extends('layouts.admin')

@section('content')   
<!-- main content area start -->
    <div class="main-content-inner">
       
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Daftar Pesanan</h2>
                        </div>
                            <div class="data-tables datatable-dark">
                                 <table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Invoice</th>
                                            <th>Nama Customer</th>
                                            <th>Tanggal Order</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td><strong><a href="order.php?orderid=2">{{ $item->invoice }}</a></strong></td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ number_format($item->total) }}</td>
                                                <td>{{ $item->status }}</td>
                                            </tr>	
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- <a href="datapesanan.php" target="_blank" class="btn btn-info">Export Data</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        
        <!-- row area start-->
    </div>
@endsection