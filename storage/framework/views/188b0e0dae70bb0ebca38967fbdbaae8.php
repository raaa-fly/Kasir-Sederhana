

<?php $__env->startSection('title', 'Profil Pengguna'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h4 class="mb-4">Profil Pengguna</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>Nama</th>
                    <td><?php echo e($user->name); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo e($user->email); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?php echo e(ucfirst($user->role)); ?></td>
                </tr>
                <tr>
                    <th>Dibuat pada</th>
                    <td><?php echo e($user->created_at->format('d M Y, H:i')); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kasir_19032\resources\views/profile/index.blade.php ENDPATH**/ ?>