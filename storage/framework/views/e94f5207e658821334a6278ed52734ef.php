

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">Laporan Penjualan</h2>

    <!-- Form filter tanggal -->
    <form method="GET" action="<?php echo e(route('report.index')); ?>" class="mb-3 d-flex align-items-center gap-2">
        <label for="tanggal">Pilih Tanggal:</label>
        <input type="date" id="tanggal" name="tanggal" class="form-control" style="max-width: 200px;" value="<?php echo e($tanggal); ?>">
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </form>

    <a href="<?php echo e(route('report.exportExcel', ['tanggal' => $tanggal])); ?>" class="btn btn-success mb-3">📥 Ekspor ke Excel</a>

    <?php if($penjualans->isEmpty()): ?>
        <div class="alert alert-info">Tidak ada data penjualan untuk tanggal <?php echo e(\Carbon\Carbon::parse($tanggal)->format('d M Y')); ?></div>
    <?php else: ?>
        <?php $__currentLoopData = $penjualans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $penjualan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <strong>Tanggal:</strong> <?php echo e($penjualan->tanggal); ?>

                </div>
                <div class="card-body">
                    <p><strong>Total Item:</strong> <?php echo e($penjualan->total_item); ?></p>
                    <?php
                        $totalPemasukan = $penjualan->detailPenjualan->sum('subtotal');
                    ?>
                    <p><strong>Total Pemasukan:</strong> Rp<?php echo e(number_format($totalPemasukan, 0, ',', '.')); ?></p>

                    <table class="table table-bordered mt-3">
                        <thead class="table-secondary">
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $penjualan->detailPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($detail->produk->nama ?? '-'); ?></td>
                                    <td><?php echo e($detail->jumlah); ?></td>
                                    <td>Rp<?php echo e(number_format($detail->subtotal, 0, ',', '.')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kasir_19032\resources\views/laporan/index.blade.php ENDPATH**/ ?>