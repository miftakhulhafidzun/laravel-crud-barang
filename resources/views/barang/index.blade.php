@extends('layouts.app')

@section('title', 'Barang')

@section('content')
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
                            <th>Deskripsi</th>
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
                            <td>{{ $dt->nama_barang }}</td>
                            <td>{{ $dt->kategori }}</td>
                            <td>{{ $dt->harga_beli }}</td>
                            <td>{{ $dt->harga_jual }}</td>
                            <td>{{ $dt->pajak }}</td>
                            <td>{{ $dt->deskripsi }}</td>
                            <td>{{ $dt->gambar }}</td>
                            <td>{{ $dt->tahun_beli }}</td>
                            <td>
                                <div class="row d-flex justify-content-around">
                                    <div class="col-md-5 p-0">
                                        <a href="{{ URL::to('barang/' . $dt->id . '/edit') }}" class="btn btn-warning btn-sm btn-block" title="Edit"><i class="fas fa-edit"></i></a>
                                    </div>
                                    <div class="col-md-5 p-0">
                                        <form action="{{url('barang', [$dt->id])}}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-sm btn-block" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
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
@endsection