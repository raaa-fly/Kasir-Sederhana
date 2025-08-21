@extends('layout')
@section('title', 'Daftar Pelanggan')
@section('icon', 'fa-users')

@section('content')
<div class="container-fluid">
    <!-- Header with modern design -->
    <div class="d-flex justify-content-between align-items-center mb-3" data-aos="fade-down">
        <div>
            <h2 class="mb-1 fw-bold">
                <i class="fas fa-users me-2 text-primary"></i> Daftar Pelanggan
            </h2>
            <p class="text-muted mb-0">Total: {{ count($pelanggans) }} pelanggan terdaftar</p>
        </div>
        <div>
            <a href="{{ route('transaksi.tambah_pelanggan') }}" class="btn btn-primary rounded-pill shadow-sm">
                <i class="fas fa-plus-circle me-2"></i> Tambah Pelanggan
            </a>
        </div>
    </div>

    <!-- Search form -->
    <form action="{{ route('pelanggan.index') }}" method="GET" class="mb-4" data-aos="fade-down">
        <div class="input-group w-100 w-md-50">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control rounded-start-pill" placeholder="Cari nama pelanggan...">
            <button class="btn btn-outline-primary rounded-end-pill" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <!-- Alert notification -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert" data-aos="zoom-in">
        <i class="fas fa-check-circle me-3 fs-4"></i>
        <div>
            <h5 class="alert-heading mb-1">Sukses!</h5>
            <p class="mb-0">{{ session('success') }}</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                            <th><i class="fas fa-user me-2 text-muted"></i>Nama Pelanggan</th>
                            <th><i class="fas fa-map-marker-alt me-2 text-muted"></i>Alamat</th>
                            <th><i class="fas fa-phone-alt me-2 text-muted"></i>Kontak</th>
                            <th class="text-end pe-4"><i class="fas fa-cogs me-2 text-muted"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggans as $pelanggan)
                        <tr class="border-top" data-aos="fade-right" data-aos-delay="{{ $loop->index * 50 }}">
                            <td class="ps-4 fw-bold">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-3">
                                        <div class="avatar-title bg-primary bg-opacity-10 rounded-circle">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $pelanggan->nama }}</h6>
                                        <small class="text-muted">ID: PLG{{ str_pad($pelanggan->id, 4, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $pelanggan->alamat }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone-alt me-2 text-muted"></i>
                                    <span>{{ $pelanggan->nomor_telepon }}</span>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-pill me-2"
                                       data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" 
                                          class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-pill"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <!-- Empty state -->
                        <tr>
                            <td colspan="5" class="text-center py-5" data-aos="zoom-in">
                                <div class="mb-4">
                                    <i class="fas fa-users fa-4x text-muted"></i>
                                </div>
                                <h5 class="fw-bold">Belum ada pelanggan</h5>
                                <p class="text-muted">Tambahkan pelanggan pertama Anda dengan mengklik tombol "Tambah Pelanggan"</p>
                                <a href="{{ route('transaksi.tambah_pelanggan') }}" class="btn btn-primary mt-3 rounded-pill">
                                    <i class="fas fa-plus-circle me-2"></i> Tambah Pelanggan
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button -->
@section('fab')
@endsection

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
@endsection
