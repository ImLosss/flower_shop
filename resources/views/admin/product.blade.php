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
                        <table id="dataTable3">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAllCheckbox">
                                        </div>
                                    </th>
                                    <th>Gambar</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Rate</th>
                                    <th>Harga Awal</th>
                                    <th>Harga Diskon</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
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
@endsection

@section('script')
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

<script>


    $(document).on('change', '.document-checkbox', function() {
        var selectedDocuments = [];
        $('.document-checkbox:checked').each(function() {
            selectedDocuments.push($(this).val());
        });
        console.log(selectedDocuments); // Tampilkan data yang dipilih dalam konsol
        // Anda dapat melakukan apa pun dengan data yang dipilih di sini, misalnya menyimpannya dalam variabel atau mengirimnya ke server
    });

    $(document).on('change', '#selectAllCheckbox', function() {
        const checkboxes = document.querySelectorAll('#dataTable3 tbody .form-check-input');

        checkboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
        var selectedDocuments = [];
        $('.document-checkbox:checked').each(function() {
            selectedDocuments.push($(this).val());
        });
        console.log(selectedDocuments); // Tampilkan data yang dipilih dalam konsol
        // Anda dapat melakukan apa pun dengan data yang dipilih di sini, misalnya menyimpannya dalam variabel atau mengirimnya ke server
    });
</script>
@endsection
