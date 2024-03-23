@extends('layouts.admin')

@section('content')   
@if ($errors->has('logo'))
    <div class='alert alert-warning'>
        {{ $errors->first() }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<!-- page title area end -->
<div class="main-content-inner">
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h2>Daftar metode pembayaran</h2>
                        <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah pembayaran</button>
                    </div>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama akun</th>
                                        <th>No. rekening</th>
                                        <th>Logo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->norek }}</td>
                                        <td><img src="{{ asset('storage/'.$item->logo) }}" width="50px"></td>
                                        <td>
                                            {{-- form delete --}}
                                            <form action="{{ route('admin.payment.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="card bg-danger border-radius-md" style="display: inline-block;" onclick="deleteAlert(this)"><i class="fa fa-trash mx-1 text-white"></i></div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach	
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row area start-->

    <!-- modal input -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah payment</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.payment.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Akun/bank</label>
                            <input name="bankName" type="text" class="form-control mb-2" required autofocus>
                            <small>@error('bankName')
                                {{ $message }}
                            @enderror</small>
                            <label>No. rekening</label>
                            <input name="norek" type="text" class="form-control mb-2" required>
                            <small>@error('norek')
                                {{ $message }}
                            @enderror</small>
                            <label>Logo</label>
                            <input name="logo" type="file" class="form-control mb-2">
                            <small>@error('logo')
                                {{ $message }}
                            @enderror</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-primary" value="Tambah">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteAlert(element) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                var form = element.closest('form');
                form.submit();
            }
        });
        return false;
    }
</script>
@endsection