<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ReportController extends Controller
{
    // Tampilkan laporan ke halaman dengan filter tanggal
    public function index(Request $request)
    {
        // Ambil tanggal dari query string, default hari ini
        $tanggal = $request->query('tanggal', Carbon::today()->toDateString());

        // Ambil data penjualan sesuai tanggal
        $penjualans = Penjualan::with('detailPenjualan.produk')
            ->whereDate('tanggal_penjualan', $tanggal)
            ->get();

        return view('laporan.index', compact('penjualans', 'tanggal'));
    }

    // Ekspor laporan ke Excel dengan filter tanggal
    public function exportExcel(Request $request)
    {
        $tanggal = $request->query('tanggal', Carbon::today()->toDateString());

        return Excel::download(new ReportExport($tanggal), "report-transaksi-{$tanggal}.xlsx");
    }
}
