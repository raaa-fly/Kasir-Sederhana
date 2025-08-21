@extends('layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Laporan Penjualan</h2>

    <!-- Form filter tanggal -->
    <form method="GET" action="{{ route('report.index') }}" class="mb-3 d-flex align-items-center gap-2">
        <label for="tanggal">Pilih Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" class="form-control" style="max-width: 200px;" value="{{ $tanggal }}">
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </form>

    <a href="{{ route('report.exportExcel', ['tanggal' => $tanggal]) }}" class="btn btn-success mb-3">📥 Ekspor ke Excel</a>

    @if ($penjualans->isEmpty())
        <div class="alert alert-info">Tidak ada data penjualan untuk tanggal {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</div>
    @else
        @foreach ($penjualans as $penjualan)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <strong>Tanggal:</strong> {{ $penjualan->tanggal }}
                </div>
                <div class="card-body">
                    <p><strong>Total Item:</strong> {{ $penjualan->total_item }}</p>
                    @php
                        $totalPemasukan = $penjualan->detailPenjualan->sum('subtotal');
                    @endphp
                    <p><strong>Total Pemasukan:</strong> Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</p>

                    <table class="table table-bordered mt-3">
                        <thead class="table-secondary">
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualan->detailPenjualan as $detail)
                                <tr>
                                    <td>{{ $detail->produk->nama ?? '-' }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
