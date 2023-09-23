@extends('layouts.app')

@section('title', 'Barang')

@section('content')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h5 class="font-weight-bold text-primary">Data Barang</h5>
            <a href="{{ URL::to('barang/create') }}" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Barang</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Pajak</th>
                            <th>Gambar</th>
                            <th>Tahun Beli</th>                            
                            <th>Aksi</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @php($no=1)
                        @foreach ($data as $dt)                            
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><a href="{{ URL::to('barang/' . $dt->id) }}">{{ $dt->nama_barang }}</a></td>
                            <td>{{ $dt->kategori }}</td>
                            <td>{{ $dt->harga_beli }}</td>
                            <td>{{ $dt->harga_jual }}</td>
                            <td>{{ $dt->pajak }}</td>
                            <td>{{ $dt->gambar }}</td>
                            <td>{{ $dt->tahun_beli }}</td>
                            <td>
                                <div class="row d-flex justify-content-around">
                                    <div class="col-md-5 p-0">
                                        <a href="{{ URL::to('barang/' . $dt->id . '/edit') }}" class="btn btn-warning btn-sm btn-block" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-5 p-0">
                                        <button type="button" class="btn btn-danger btn-sm" title="Delete"
                                            onclick="loadDeleteModal({{ $dt->id }}, '{{ $dt->nama_barang }}')"><i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>                                             
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteBarang" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="deleteBarang" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">This action is not reversible.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <span id="modal-nama_barang"></span>?
                    <input type="hidden" id="barang" name="id_barang">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="modal-confirm_delete" onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        function loadDeleteModal(id, name) {
            $('#modal-nama_barang').html(name);
            $('#modal-confirm_delete').attr('data-id', id);
            $('#deleteBarang').modal('show');
        }

        function confirmDelete() {
            var id = $('#modal-confirm_delete').data('id');
            console.log(id);
            $.ajax({
                url: '{{ url('barang') }}/' + id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
                },
                success: function (data) {
                    console.log('berhasil delete');
                    $('#deleteBarang').modal('hide');
                    window.location.reload();
                },
                error: function (error) {
                    console.log('gagal delete');
                }
            });
        }
    </script>
@endsection 