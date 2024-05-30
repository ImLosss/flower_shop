@extends('layouts.admin')

@section('content')   
<style>
    #modalOverlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 999;
    }

    #modalContent {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    #fullSizeImage {
        max-width: 55%;
        max-height: 55%;
    }
</style>

<div id="modalOverlay">
    <div id="modalContent">
        <img id="fullSizeImage">
    </div>
</div>


<!-- page title area end -->
<div class="main-content-inner">
   
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h3>Order id : {{ $data->invoice }}</h3>
                    </div>
                    <p>{{ $data->user->name }} ({{ $data->user->alamat }})</p>
                    <p>Waktu order : {{ $data->updated_at }}</p>
                    <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->detailOrder as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>Rp{{ number_format($item->product->disc) }}</td>
                                    <td>Rp{{ number_format($item->total) }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align:right">Total:</th>
                                    <th>Rp{{ number_format($data->total) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <br>
                        Informasi Pembayaran
                    <div class="data-tables datatable-dark">
                        <table id="dataTable2" class="display" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Metode</th>
                                    <th>Pemilik Rekening</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Bukti Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $data->payment->name }}</td>
                                    <td>{{ $data->confirm->sender_account_name }}</td>
                                    <td>{{ $data->confirm->created_at }}</td>
                                    <td><img class="thumbnail" src="{{ asset('image_uploads/'.$data->confirm->proof_of_payment) }}" data-fullsize="{{ asset('image_uploads/'.$data->confirm->proof_of_payment) }}" style="width: 50px;"> Klik gambar untuk melihat</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br><br>
                    @if ($data->status == 'pending')
                        <form action="{{ route('admin.manageorder.confirm', $data->invoice) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="submit" class="form-control btn btn-success" value="Konfirmasi pembayaran">
                        </form>
                    @elseif($data->status == 'proses')
                        <form action="{{ route('admin.manageorder.kirim', $data->invoice) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="submit" class="form-control btn btn-success" value="Kirim">
                        </form>
                    @elseif($data->status == 'pengiriman')
                        <form action="{{ route('admin.manageorder.selesai', $data->invoice) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <input type="submit" class="form-control btn btn-success" value="Selesaikan">
                        </form>
                    @endif
                    <br>
                </div>
            </div>
        </div>
    <!-- row area start-->
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const thumbnails = document.querySelectorAll(".thumbnail");
        const modalOverlay = document.getElementById("modalOverlay");
        const fullSizeImage = document.getElementById("fullSizeImage");

        thumbnails.forEach(function(thumbnail) {
            thumbnail.addEventListener("click", function() {
                const fullsize = this.getAttribute("data-fullsize");
                fullSizeImage.src = fullsize;
                modalOverlay.style.display = "block";
            });
        });

        modalOverlay.addEventListener("click", function() {
            modalOverlay.style.display = "none";
        });

        modalContent.addEventListener("click", function(event) {
            event.stopPropagation();
        });
    });

</script>
@endsection