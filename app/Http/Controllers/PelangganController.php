<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    // Menampilkan daftar pelanggan
public function index(Request $request)
{
    $query = Pelanggan::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    $pelanggans = $query->get();

    return view('pelanggan.index', compact('pelanggans'));
}


    // Menampilkan form tambah pelanggan
    public function create()
    {
        return view('pelanggan.create');
    }

    // Menyimpan pelanggan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
        ]);

        // Simpan pelanggan
        $pelanggan = Pelanggan::create($request->all());

        // Redirect ke form tambah produk dengan pelanggan_id
        return redirect()->route('transaksi.pilih_produk', ['pelanggan_id' => $pelanggan->id]);
    }
    // Menampilkan detail pelanggan tertentu
    public function show(Pelanggan $pelanggan)
    {
        return view('pelanggan.show', compact('pelanggan'));
    }

    // Menampilkan form edit pelanggan
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    // Memperbarui data pelanggan
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil diperbarui.');
    }

    // Menghapus pelanggan dari database
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
                         ->with('success', 'Pelanggan berhasil dihapus.');
    }
}
