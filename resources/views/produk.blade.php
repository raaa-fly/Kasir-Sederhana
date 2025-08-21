@extends('layout')
@section('title', 'Daftar Produk')
@section('icon', 'fa-boxes')

@section('content')
<div class="container-fluid">
    <!-- Header with modern design -->
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <div>
            <h2 class="mb-1 fw-bold">
                <i class="fas fa-boxes me-2 text-primary"></i> Daftar Produk
            </h2>
            <p class="text-muted mb-0">Total: {{ count($produks) }} produk tersedia</p>
        </div>
        @if(Auth::user()->role !== 'petugas')
        <a href="{{ route('produk.create') }}" class="btn btn-primary rounded-pill shadow-sm" data-aos="zoom-in">
            <i class="fas fa-plus me-2"></i> Tambah Produk
        </a>
        @endif
    </div>

    <!-- Alert notification -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-4" role="alert" data-aos="zoom-in">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-4"></i>
                <div>
                    <h5 class="alert-heading mb-1">Sukses!</h5>
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Card container -->
    <div class="card border-0 shadow-sm" data-aos="fade-up">
        <div class="card-body p-0">
            <!-- Responsive table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">#</th>
                            <th><i class="fas fa-box me-2 text-muted"></i>Nama Produk</th>
                            <th><i class="fas fa-money-bill-wave me-2 text-muted"></i>Harga</th>
                            <th><i class="fas fa-warehouse me-2 text-muted"></i>Stok</th>
                            @if(Auth::user()->role !== 'petugas')
                            <th class="text-end pe-4"><i class="fas fa-cogs me-2 text-muted"></i>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produks as $produk)
                        <tr class="border-top" data-aos="fade-right" data-aos-delay="{{ $loop->index * 50 }}">
                            <td class="ps-4 fw-bold">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($produk->foto)
                                    <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama }}" 
                                         class="rounded me-3" width="40" height="40">
                                    @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-box text-muted"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-0">{{ $produk->nama }}</h6>
                                        <small class="text-muted">{{ $produk->kode_produk }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-success fw-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge rounded-pill py-2 px-3 
                                    {{ $produk->stok > 10 ? 'bg-success bg-opacity-10 text-success' : 
                                       ($produk->stok > 0 ? 'bg-warning bg-opacity-10 text-warning' : 'bg-danger bg-opacity-10 text-danger') }}">
                                    <i class="fas {{ $produk->stok > 10 ? 'fa-check' : ($produk->stok > 0 ? 'fa-exclamation' : 'fa-times') }} me-1"></i>
                                    {{ $produk->stok }} pcs
                                </span>
                            </td>
                            @if(Auth::user()->role !== 'petugas')
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('produk.edit', $produk) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-pill me-2"
                                       data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" 
                                          class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-pill"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty state -->
            @if(count($produks) == 0)
            <div class="text-center py-5" data-aos="zoom-in">
                <div class="mb-4">
                    <i class="fas fa-box-open fa-4x text-muted"></i>
                </div>
                <h5 class="fw-bold">Belum ada produk</h5>
                <p class="text-muted">Tambahkan produk pertama Anda dengan mengklik tombol "Tambah Produk"</p>
                @if(Auth::user()->role !== 'petugas')
                <a href="{{ route('produk.create') }}" class="btn btn-primary mt-3 rounded-pill">
                    <i class="fas fa-plus me-2"></i> Tambah Produk
                </a>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Floating Action Button -->
@if(Auth::user()->role !== 'petugas')
@section('fab')
<button class="fab" onclick="window.location.href='{{ route('produk.create') }}'">
    <i class="fas fa-plus"></i>
</button>
@endsection
@endif

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
@endsection