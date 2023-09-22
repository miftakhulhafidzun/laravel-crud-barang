@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit Barang</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $barang->kategori }}" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="harga_beli">Harga Beli</label>
                <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{ $barang->harga_beli }}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="harga_jual">Harga Jual</label>
                <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ $barang->harga_jual }}" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="pajak">Pajak (%)</label>
                <input type="number" class="form-control" id="pajak" name="pajak" min="0" max="100" step="0.01" value="{{ $barang->pajak }}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tahun_beli">Tahun Beli</label>
                <input type="number" class="form-control" id="tahun_beli" name="tahun_beli" value="{{ $barang->tahun_beli }}" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $barang->deskripsi }}</textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar" accept="image/*">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-icon-split">
              <span class="icon text-white-50">
                  <i class="fas fa-save"></i>
              </span>
              <span class="text">Update</span>
          </button>
          <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-icon-split">
              <span class="icon text-white-50">
                  <i class="fas fa-chevron-left"></i>
              </span>
              <span class="text">Kembali</span>
          </a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
