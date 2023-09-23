@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')

<div class="row">
    <div class="col-md-4">
        <img src="{{ asset('uploads/barang/'. $data->gambar) }}" class="img-fluid shadow rounded" alt="Gambar Produk">
    </div>
    <div class="col-md-8">
        <h2 class="font-weight-bold text-gray-900">{{ $data->nama_barang }}</h2>    
        <p id="kategori" class="badge badge-pill badge-primary">{{ $data->kategori }}</p>

        <div class="row">
            <div class="col-8">
                <div class="mb-3">
                    <label for="deskripsi" class="text-gray-500">Deskripsi:</label>
                    <p id="deskripsi">{{ $data->deskripsi }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="tahun_beli" class="text-gray-500">Tahun Beli:</label>
                <strong>
                    <p id="tahun_beli">{{ $data->tahun_beli }}</p>
                </strong>
            </div>
            <div class="col-md-4">
                <label for="pajak" class="text-gray-500">Pajak:</label>
                <strong>
                    <p id="pajak">{{ $data->pajak }}</p>
                </strong>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="harga_beli" class="text-gray-500">Harga Beli:</label>
                <strong>
                    <p id="harga_beli">Rp {{ number_format($data->harga_beli, 2) }}</p>
                </strong>
            </div>
            <div class="col-md-4">
                <label for="harga_jual" class="text-gray-500">Harga Jual:</label>
                <strong>
                    <p id="harga_jual">Rp {{ number_format($data->harga_jual, 2) }}</p>
                </strong>
            </div>
        </div>
    </div>
    
</div>
<br>
<a href="{{ route('barang.index') }}" class="btn btn-secondary btn-icon-split">
    <span class="icon text-white-50">
        <i class="fas fa-chevron-left"></i>
    </span>
    <span class="text">Kembali</span>
</a>


@endsection