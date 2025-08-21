<?php

namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    protected $tanggal;

    // Terima tanggal saat dibuat object
    public function __construct($tanggal = null)
    {
        $this->tanggal = $tanggal;
    }

    public function collection()
    {
        $query = Penjualan::with('detailPenjualan.produk');

        if ($this->tanggal) {
            $query->whereDate('tanggal_penjualan', $this->tanggal);
        }

        $penjualans = $query->get();

        $data = [];

        foreach ($penjualans as $penjualan) {
            // Hitung total pemasukan jika tidak tersedia di model
            $totalPemasukan = $penjualan->detailPenjualan->sum('subtotal');

            foreach ($penjualan->detailPenjualan as $detail) {
                $data[] = [
                    'tanggal' => $penjualan->tanggal_penjualan,
                    'produk' => $detail->produk->nama ?? '-',
                    'jumlah' => $detail->jumlah,
                    'subtotal' => $detail->subtotal,
                    'total_item' => $penjualan->total_item,
                    'total_pemasukan' => $totalPemasukan,
                ];
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Produk',
            'Jumlah',
            'Subtotal',
            'Total Item',
            'Total Pemasukan',
        ];
    }
}
