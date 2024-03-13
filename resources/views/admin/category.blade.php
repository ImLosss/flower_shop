@extends('layouts.admin')

@section('content')   
<!-- page title area end -->
<div class="main-content-inner">
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h2>Daftar Kategori</h2>
                        <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah Kategori</button>
                    </div>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kategori</th>
                                        <th>Jumlah Produk</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->product->count() }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            {{-- form delete --}}
                                            <form action="{{ route('admin.category.destroy', $item->id) }}" method="POST">
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
                    <h4 class="modal-title">Tambah Kategori</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.category.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input name="categoryName" type="text" class="form-control" required autofocus>
                            <small>@error('categoryName')
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