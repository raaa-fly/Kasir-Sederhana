

<?php $__env->startSection('title', 'Dashboard Petugas'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
            <h4>Selamat datang, <?php echo e(Auth::user()->name); ?>!</h4>
            <p>Anda berhasil login sebagai <strong><?php echo e(Auth::user()->role); ?></strong>.</p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kasir_19032\resources\views/dashboard/kasir.blade.php ENDPATH**/ ?>