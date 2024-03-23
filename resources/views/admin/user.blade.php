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
                        <h2>Daftar User</h2>
                    </div>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Notelp</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->notelp }}</td>
                                        <td>
                                            {{-- form delete --}}
                                            <form action="{{ route('admin.user.destroy', $item->id) }}" method="POST">
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