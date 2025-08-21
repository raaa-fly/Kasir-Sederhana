
<?php $__env->startSection('title', 'Edit Pelanggan'); ?>
<?php $__env->startSection('icon', 'fa-user-edit'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-down">
        <div>
            <h2 class="mb-1 fw-bold">
                <i class="fas fa-user-edit me-2 text-warning"></i> Edit Pelanggan
            </h2>
            <p class="text-muted mb-0">Ubah data pelanggan berikut sesuai kebutuhan</p>
        </div>
        <a href="<?php echo e(route('transaksi.create')); ?>" class="btn btn-secondary rounded-pill shadow-sm">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <!-- Error Alert -->
    <?php if($errors->any()): ?>
        <div class="alert alert-danger" data-aos="zoom-in">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Edit Form -->
    <div class="card border-0 shadow-sm" data-aos="fade-up">
        <div class="card-body">
            <form action="<?php echo e(route('pelanggan.update', $pelanggan->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold">
                        <i class="fas fa-user me-2 text-muted"></i>Nama
                    </label>
                    <input type="text" name="nama" class="form-control rounded-pill" value="<?php echo e(old('nama', $pelanggan->nama)); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold">
                        <i class="fas fa-map-marker-alt me-2 text-muted"></i>Alamat
                    </label>
                    <textarea name="alamat" class="form-control rounded" rows="3" required><?php echo e(old('alamat', $pelanggan->alamat)); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="nomor_telepon" class="form-label fw-semibold">
                        <i class="fas fa-phone-alt me-2 text-muted"></i>Nomor Telepon
                    </label>
                    <input type="text" name="nomor_telepon" class="form-control rounded-pill" value="<?php echo e(old('nomor_telepon', $pelanggan->nomor_telepon)); ?>" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kasir_19032\resources\views/pelanggan/edit.blade.php ENDPATH**/ ?>