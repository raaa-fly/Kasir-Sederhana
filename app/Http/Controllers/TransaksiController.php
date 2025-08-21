<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\Report;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Display all transactions
    public function index()
    {
        // Urutkan dari yang terbaru berdasarkan created_at dan tanggal_penjualan
        $transaksis = Penjualan::with('pelanggan', 'detailPenjualan.produk')
        
                      ->orderBy('created_at', 'desc') // Ditambahkan
                      ->orderBy('tanggal_penjualan', 'desc')
                      ->get();
                    
    
        return view('transaksi.index', compact('transaksis'));
    }   

    // Show search form to find customers
    public function create(Request $request)
    {
        $keyword = $request->keyword;
        
        $pelanggans = Pelanggan::when($keyword, function ($query) use ($keyword) {
            return $query->where('nama', 'like', "%$keyword%");
        })->get();
    
        return view('transaksi.create', compact('pelanggans'));
    }

    // Store new customer and redirect to the transaction process
    public function store(Request $request)
    {
        // Validate customer data
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
        ]);

        // Create a new customer
        $pelanggan = Pelanggan::create($request->only('nama', 'alamat', 'nomor_telepon'));

        // Redirect to select products for the transaction
        return redirect()->route('transaksi.pilih_produk', ['pelanggan_id' => $pelanggan->id]);
    }

    // Show the page to select products for the transaction
    public function pilihProduk(Request $request, $pelanggan_id)
{
    // Ambil data pelanggan
    $pelanggan = Pelanggan::findOrFail($pelanggan_id);

    // Ambil query pencarian jika ada
    $search = $request->input('search');

    // Ambil produk berdasarkan pencarian (jika ada)
    $produks = Produk::when($search, function ($query) use ($search) {
        return $query->where('nama', 'like', '%' . $search . '%');
    })->get();

    // Tampilkan halaman pilih produk
    return view('transaksi.pilih_produk', compact('pelanggan', 'produks', 'search'));
}


    // Store the selected products and finalize the transaction
    public function simpanProduk(Request $request)
    {
        // Validate the input data
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'produk_id' => 'required|array',
            'jumlah' => 'required|array',
            'created_at' => now(), // Pastikan ini ada
            'updated_at' => now()
        
        ]);

        // Calculate the total price of the transaction
        $totalHarga = 0;
        foreach ($request->produk_id as $index => $produk_id) {
            $produk = Produk::findOrFail($produk_id);
            $totalHarga += $produk->harga * $request->jumlah[$index];

            // Decrease the stock of the selected product
            $produk->decrement('stok', $request->jumlah[$index]);
        }

        // Create a new transaction record in Penjualan table
        $penjualan = Penjualan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal_penjualan' => now(),
            'total_harga' => $totalHarga,
        ]);

        // Save the transaction details in DetailPenjualan table
        foreach ($request->produk_id as $index => $produk_id) {
            $produk = Produk::findOrFail($produk_id);
            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'produk_id' => $produk_id,
                'jumlah' => $request->jumlah[$index],
                'subtotal' => $produk->harga * $request->jumlah[$index],
            ]);
        }

        // Redirect to the transactions index page with a success message
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    // Search for customers based on the keyword
    public function cariPelanggan(Request $request)
    {
        $keyword = $request->keyword;

        // Default to an empty collection if no keyword is provided
        $pelanggans = collect();

        if ($keyword) {
            $pelanggans = Pelanggan::where('nama', 'LIKE', "%{$keyword}%")->get();
        }

        // Return the customer search view with results
        return view('transaksi.create', compact('pelanggans'));
    }

    // Proceed to the transaction page after selecting the customer
    public function lanjutkanTransaksi(Request $request)
    {
        // Validate the selected pelanggan_id
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
        ]);
    
        $pelanggan = Pelanggan::findOrFail($request->pelanggan_id);
    
        // Redirect to pilih_produk page
        return redirect()->route('transaksi.pilih_produk', ['pelanggan_id' => $pelanggan->id]);
    }

    // Show the details of a specific transaction
    public function show($id)
    {
        // Retrieve the transaction by ID
        $transaksi = Penjualan::with('pelanggan', 'detailPenjualan.produk')->findOrFail($id);

        // Return the transaction details view
        return view('transaksi.show', compact('transaksi'));
    }
    public function tambahPelanggan()
    {
        return view('transaksi.tambah_pelanggan');
    }

    // Store the new customer
    public function storePelanggan(Request $request)
    {
        // Validate the request
        $request->validate([
            'nama' => 'required|string|max:255|unique:pelanggans',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15|unique:pelanggans',
        ]);

        // Create new customer
        Pelanggan::create($request->all());

        // Redirect back with success message
        return redirect()->route('transaksi.create')->with('success', 'Pelanggan berhasil ditambahkan');
    }


    public function resetTransaksi()
{
    // Ambil data penjualan dan detailnya
    $penjualans = Penjualan::with('detailPenjualan')->get();

    // Hitung total pemasukan dan total item yang terjual
    $totalPemasukan = 0;
    $totalItem = 0;

    foreach ($penjualans as $penjualan) {
        $totalPemasukan += $penjualan->total_harga;
        foreach ($penjualan->detailPenjualan as $detail) {
            $totalItem += $detail->jumlah;
        }
    }

    // Simpan ke laporan dalam satu entri
    Report::create([
        'tanggal' => now()->toDateString(),
        'total_item' => $totalItem,
        'total_pemasukan' => $totalPemasukan,
    ]);

    // Nonaktifkan pengecekan foreign key sementara
    DB::statement('SET FOREIGN_KEY_CHECKS=0');

    // Hapus semua transaksi
    DetailPenjualan::truncate();
    Penjualan::truncate();

    // Aktifkan kembali pengecekan foreign key
    DB::statement('SET FOREIGN_KEY_CHECKS=1');

    // Redirect dengan pesan sukses
    return redirect()->route('transaksi.index')->with('success', 'Semua transaksi berhasil direset dan disimpan ke laporan!');
}

public function laporan()
    {
        // Ambil semua data laporan yang ada
        $laporans = Report::all();

        // Kirim ke view laporan.index
        return view('laporan.index', compact('laporans'));
    }
    
}

