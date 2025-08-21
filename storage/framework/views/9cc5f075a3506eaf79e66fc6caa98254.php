
<?php $__env->startSection('title', 'Transaksi'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fas fa-receipt me-2"></i>Daftar Transaksi</h2>
        
        <div class="d-flex">
            <a href="<?php echo e(route('transaksi.create')); ?>" class="btn btn-primary me-2">
                <i class="fas fa-plus-circle me-1"></i> Tambah Transaksi
            </a>
            
            <form action="<?php echo e(route('transaksi.reset')); ?>" method="POST" onsubmit="return confirm('Yakin ingin reset semua transaksi? Data akan disimpan ke laporan.')">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash-restore me-1"></i> Reset Semua
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $transaksis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaksi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-3">
                                        <div class="avatar-title bg-light rounded">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-0"><?php echo e($transaksi->pelanggan->nama ?? 'Tanpa Pelanggan'); ?></h6>
                                        <small class="text-muted"><?php echo e($transaksi->pelanggan->nomor_telepon ?? '-'); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <i class="far fa-calendar-alt me-1 text-muted"></i>
                                <?php echo e($transaksi->tanggal_penjualan); ?>

                            </td>
                            <td class="fw-bold text-success">
                                <i class="fas fa-tag me-1"></i>
                                Rp <?php echo e(number_format($transaksi->total_harga, 0, ',', '.')); ?>

                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailTransaksi<?php echo e($transaksi->id); ?>">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </button>

                                <?php if(auth()->user()->role !== 'petugas'): ?>
                                    <a href="<?php echo e(route('transaksi.edit', $transaksi->id)); ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="<?php echo e(route('transaksi.destroy', $transaksi->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php $__currentLoopData = $transaksis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaksi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="detailTransaksi<?php echo e($transaksi->id); ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-receipt me-2"></i> Detail Transaksi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="printArea<?php echo e($transaksi->id); ?>">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6><i class="fas fa-user me-2"></i> Informasi Pelanggan</h6>
                        <hr class="mt-1">
                        <p><strong>Nama:</strong> <?php echo e($transaksi->pelanggan->nama ?? '-'); ?></p>
                        <p><strong>Nomor Telepon:</strong> <?php echo e($transaksi->pelanggan->nomor_telepon ?? '-'); ?></p>
                        <p><strong>Alamat:</strong> <?php echo e($transaksi->pelanggan->alamat ?? '-'); ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-info-circle me-2"></i> Informasi Transaksi</h6>
                        <hr class="mt-1">
                        <p><strong>Tanggal:</strong> <?php echo e($transaksi->tanggal_penjualan); ?></p>
                        <p><strong>ID Transaksi:</strong> <?php echo e($transaksi->id); ?></p>
                        <p><strong>Petugas:</strong> <?php echo e(Auth::user()->name); ?></p>
                    </div>
                </div>
                
                <!-- Bagian daftar produk tetap sama -->

                
                <h6><i class="fas fa-shopping-basket me-2"></i> Daftar Produk</h6>
                <hr class="mt-1">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $transaksi->detailPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <i class="fas fa-box me-2 text-muted"></i>
                                <?php echo e($detail->produk->nama ?? 'Produk Tidak Ada'); ?>

                            </td>
                            <td class="text-center"><?php echo e($detail->jumlah); ?></td>
                            <td class="text-end">Rp <?php echo e(number_format($detail->subtotal, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr class="table-active">
                            <th colspan="2" class="text-end">Total Harga:</th>
                            <th class="text-end">Rp <?php echo e(number_format($transaksi->total_harga, 0, ',', '.')); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Tutup
                </button>
                <button type="button" class="btn btn-success" onclick="printStruk(<?php echo e($transaksi->id); ?>)">
                    <i class="fas fa-print me-1"></i> Print Struk
                </button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
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
    .modal-header {
        border-radius: 0;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function printStruk(id) {
        var content = document.getElementById('printArea' + id).innerHTML;
        var printWindow = window.open('', '', 'width=800,height=600');
        printWindow.document.write('<html><head><title>Struk Transaksi #' + id + '</title>');
        printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">');
        printWindow.document.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">');
        printWindow.document.write('<style>body { font-size: 14px; } .table { width: 100%; } .text-end { text-align: right; }</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div class="container mt-3">');
        printWindow.document.write('<h4 class="text-center mb-4"><i class="fas fa-receipt me-2"></i>Struk Transaksi #' + id + '</h4>');
        printWindow.document.write(content);
        printWindow.document.write('</div>');
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kasir_19032\resources\views/transaksi/index.blade.php ENDPATH**/ ?>