@extends('layouts.admin')

@section('content')   
@if ($errors->has('name') || $errors->has('image') || $errors->has('categoryId'))
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
                        <h2>Daftar Produk</h2>
                        <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2" onclick="reset()">Tambah Produk</button>
                    </div>
                    <div class="data-tables datatable-dark">
                        <table id="dataTable3" class="display" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="pr-4">No.</th>
                                    <th class="pr-4">Gambar</th>
                                    <th class="pr-4">Nama Produk</th>
                                    <th class="pr-4">Kategori</th>
                                    <th class="pr-4">Deskripsi</th>
                                    <th class="pr-4">Rate</th>
                                    <th class="pr-4">Harga Awal</th>
                                    <th class="pr-4">Harga Diskon</th>
                                    <th class="pr-4">Tanggal</th>
                                    <th class="pr-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td width="150px"><img src="{{ asset('storage/' . $item->src_img) }}" width="50%"></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->rate }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->disc }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <div class="card bg-success border-radius-md" style="display: inline-block;" onclick="getdata(this)" data-toggle="modal" data-target="#myModal" data-id="{{ $item->id }}" data-oldimg="{{ $item->src_img }}" data-categoryid="{{ $item->category->id }}" data-name="{{ $item->name }}" data-description="{{ $item->description }}" data-rate="{{ $item->rate }}" data-price="{{ $item->price }}" data-disc="{{ $item->disc }}"><i class="fa fa-edit mx-1 text-white"></i></div>
                                            <div class="card bg-danger border-radius-md" style="display: inline-block;" onclick="submit({{ $key }})"><i class="fa fa-trash mx-1 text-white"></i></div>
                                            {{-- form delete --}}
                                            <form id="form_{{ $key }}" action="{{ route('admin.product.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
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

<!-- modal input -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleEdit">Tambah Produk</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.product.store') }}" method="post" id="modalForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="old_img" name="old_img">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input name="name" id="name" type="text" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <select name="categoryId" class="form-control" id="categoryId">
                            <option selected value="0" disabled>Pilih Kategori</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input name="description" id="description" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Rating (1-5)</label>
                        <input name="rate" type="number" id="rate" class="form-control" min="1" max="5" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Sebelum Diskon</label>
                        <input name="price" id="price" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Harga Setelah Diskon</label>
                        <input name="disc" id="disc" type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input name="image" type="file" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input name="addproduct" type="submit" id="modalbtnsubmit" class="btn btn-primary" value="Tambah">
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    function getdata(data) {

        // Mendapatkan nilai data-* menggunakan dataset
        var id = data.dataset.id;
        var old_img = data.dataset.oldimg;
        var categoryid = data.dataset.categoryid;
        var name = data.dataset.name;
        var description = data.dataset.description;
        var rate = data.dataset.rate;
        var price = data.dataset.price;
        var disc = data.dataset.disc;
        var action = `{{ route('admin.product.update', ':id') }}`.replace(':id', id);

        $('#old_img').val(old_img);
        $('#name').val(name);
        $('#description').val(description);
        $('#categoryId').val(categoryid);
        $('#price').val(price);
        $('#disc').val(disc);
        $('#rate').val(rate);
        $('#modalbtnsubmit').val('Edit');
        $('#titleEdit').text('Edit produk');
        $('#modalForm').attr('action', action);

        // Find the form element
        var form = document.getElementById('modalForm');

        var methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PATCH';
        methodInput.id = 'patch';
        // Append the hidden input field to the form
        form.appendChild(methodInput);
    }

    function reset() {
        $('#name').val('');
        $('#description').val('');
        $('#categoryId').val('0');
        $('#price').val('');
        $('#disc').val('');
        $('#rate').val('');
        $('#modalbtnsubmit').val('Add');
        $('#titleEdit').text('Add produk');
        $('#modalForm').attr('action', "{{ route('admin.product.store') }}");

        // Find the form element
        var element = document.getElementById('patch');

        if(element) element.remove();
    }

    function submit(key) {
        $('#form_'+key).submit();
    }
</script>
@endsection