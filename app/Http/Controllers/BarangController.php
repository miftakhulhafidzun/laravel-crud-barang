<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = DB::table('barangs')->get();

        return view('barang.index', ['data'=>$barang]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan melalui form
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'pajak' => 'required|numeric',
            'deskripsi' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ubah sesuai dengan ekstensi gambar yang diperbolehkan dan ukuran maksimal
            'tahun_beli' => 'required|integer',
        ]);

        // Mengkonversi input pajak menjadi persentase jika lebih besar dari 1
        if ($request->input('pajak') > 1) {
            $request->merge(['pajak' => $request->input('pajak') / 100]);
        }

        // Simpan data barang ke dalam database menggunakan Query Builder
        DB::table('barangs')->insert([
            'nama_barang' => $request->input('nama_barang'),
            'kategori' => $request->input('kategori'),
            'harga_beli' => $request->input('harga_beli'),
            'harga_jual' => $request->input('harga_jual'),
            'pajak' => $request->input('pajak'),
            'deskripsi' => $request->input('deskripsi'),
            'tahun_beli' => $request->input('tahun_beli'),
            'gambar' => '', // Nama gambar akan diisi nanti setelah proses upload
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads/barang'), $gambarName);

            // Update nama gambar dalam database
            DB::table('barangs')
                ->where('nama_barang', $request->input('nama_barang'))
                ->update(['gambar' => $gambarName]);
        }

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barang = DB::table('barangs')->where('id', $id)->first();

        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan.');
        }

        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'pajak' => 'required|numeric',
            'deskripsi' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan aturan validasi gambar yang Anda inginkan
            'tahun_beli' => 'required|integer',
        ]);

        // Mengkonversi input pajak menjadi persentase jika lebih besar dari 1
        if ($request->input('pajak') > 1) {
            $request->merge(['pajak' => $request->input('pajak') / 100]);
        }

        // Cari data barang berdasarkan ID
        $barang = DB::table('barangs')->where('id', $id)->first();

        if (!$barang) {
            return redirect()->route('barang.index')->with('error', 'Barang tidak ditemukan');
        }

        // Update data barang menggunakan Query Builder
        DB::table('barangs')
            ->where('id', $id)
            ->update([
                'nama_barang' => $request->input('nama_barang'),
                'kategori' => $request->input('kategori'),
                'harga_beli' => $request->input('harga_beli'),
                'harga_jual' => $request->input('harga_jual'),
                'pajak' => $request->input('pajak'),
                'deskripsi' => $request->input('deskripsi'),
                'tahun_beli' => $request->input('tahun_beli'),
                'updated_at' => now(),
            ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('uploads/barang'), $gambarName);

            // Update nama gambar dalam database
            DB::table('barangs')
                ->where('id', $id)
                ->update(['gambar' => $gambarName]);
        }

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        return response()->json($barang);
    }
}
