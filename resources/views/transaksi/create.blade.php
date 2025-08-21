@extends('layout')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-users me-2"></i>Cari Pelanggan</h2>
        <a href="{{ route('transaksi.tambah_pelanggan') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-1"></i> Tambah Pelanggan Baru
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('transaksi.create') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" name="keyword" class="form-control border-start-0" 
                           placeholder="Cari nama pelanggan..." value="{{ request('keyword') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
            </form>

            @if(request('keyword'))
                <div class="alert alert-light mt-3 mb-0">
                    <i class="fas fa-info-circle me-2"></i> Menampilkan hasil pencarian untuk: "{{ request('keyword') }}"
                </div>
            @endif
        </div>
    </div>

    <form action="{{ route('transaksi.lanjutkan') }}" method="POST" id="formLanjutTransaksi">
        @csrf
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="120">Aksi</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelanggans as $pelanggan)
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-primary select-btn" 
                                            data-pelanggan-id="{{ $pelanggan->id }}">
                                        <i class="fas fa-arrow-right me-1"></i> Lanjut
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-3">
                                            <div class="avatar-title bg-light rounded">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $pelanggan->nama }}</h6>
                                            <small class="text-muted">ID: {{ $pelanggan->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $pelanggan->alamat }}</td>
                                <td>
                                    <i class="fas fa-phone-alt me-1 text-muted"></i>
                                    {{ $pelanggan->nomor_telepon }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-user-slash text-muted mb-2" style="font-size: 2rem;"></i>
                                        <p class="mb-0">Data tidak ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <input type="hidden" name="pelanggan_id" id="selectedPelangganId">
    </form>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    .avatar-sm {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .avatar-title {
        font-size: 1.2rem;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }
    .card {
        border-radius: 10px;
    }
    .input-group-text {
        transition: all 0.2s;
    }
    .select-btn:hover {
        transform: translateX(3px);
        transition: all 0.2s;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle click on the select button
        document.querySelectorAll('.select-btn').forEach(button => {
            button.addEventListener('click', function() {
                const pelangganId = this.getAttribute('data-pelanggan-id');
                document.getElementById('selectedPelangganId').value = pelangganId;
                document.getElementById('formLanjutTransaksi').submit();
            });
        });

        // Add animation to search input focus
        const searchInput = document.querySelector('input[name="keyword"]');
        searchInput.addEventListener('focus', function() {
            this.parentElement.querySelector('.input-group-text').classList.add('bg-primary', 'text-white');
        });
        searchInput.addEventListener('blur', function() {
            this.parentElement.querySelector('.input-group-text').classList.remove('bg-primary', 'text-white');
        });
    });
</script>
@endpush