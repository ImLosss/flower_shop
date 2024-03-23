@extends('layouts.admin')

@section('content')
    
        
        <!-- page title area end -->
        <div class="main-content-inner">
        
            
            <div class="sales-report-area mt-5 mb-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-report mb-xs-30">
                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                <div class="icon"><i class="fa fa-user"></i></div>
                                <div class="s-report-title d-flex justify-content-between">
                                    <h4 class="header-title mb-0">Pelanggan</h4>
                                </div>
                                <div class="d-flex justify-content-between pb-2">
                                    <h1>{{ $pelanggan }}</h1>
                                </div>
                                </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="single-report">
                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                <div class="icon"><i class="fa fa-book"></i></div>
                                <div class="s-report-title d-flex justify-content-between">
                                    <h4 class="header-title mb-0">Pesanan</h4>
                                </div>
                                <div class="d-flex justify-content-between pb-2">
                                    <h1>{{ $pesanan }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-report mb-xs-30">
                            <div class="s-report-inner pr--20 pt--30 mb-3">
                                <div class="icon"><i class="fa fa-link"></i></div>
                                <div class="s-report-title d-flex justify-content-between">
                                    <h4 class="header-title mb-0">Konfirmasi Pembayaran</h4>
                                </div>
                                <div class="d-flex justify-content-between pb-2">
                                    <h1>{{ $konfirmasi }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <!-- overview area end -->
            <!-- market value area start -->
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Selamat Datang</h2>
                            </div>
                            <div class="market-status-table mt-4">
                                Anda masuk sebagai <strong>{{Auth::user()->name}}</strong>
                                <br>
                                <p>Pada halaman admin, Anda dapat menambah kategori produk, mengelola produk, 
                                mengelola user dan admin, melihat konfirmasi pembayaran</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            
            <!-- row area start-->
        </div>
    <!-- main content area end -->
@endsection