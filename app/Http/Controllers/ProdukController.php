<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Pelanggan;


class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('produk', compact('produks'));
    }

    
    public function create(Request $request)
    {
        $keyword = $request->keyword;
    
        $pelanggans = Pelanggan::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })->get();
    
        return view('produk.tambahproduk', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'barcode' => 'required|unique:produks,barcode',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);
    
        $produk = Produk::create([
            'nama' => $request->nama,
            'barcode' => $request->barcode,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
    
        if ($produk) {
            return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
        } else {
            return back()->with('error', 'Gagal menyimpan produk.');
        }
    }
    
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);
    
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());
    
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }
    

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
