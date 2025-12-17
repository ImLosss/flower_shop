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
                                <table id="dataTable3">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
