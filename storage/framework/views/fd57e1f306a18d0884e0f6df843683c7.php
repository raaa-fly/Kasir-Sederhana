 

<?php $__env->startSection('title', 'Registrasi Pengguna'); ?>

<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Beranda</a></li>
<li class="breadcrumb-item active">Registrasi</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<h2 class="text-2xl font-bold text-center mb-6">Registrasi Pengguna</h2>

<?php if(session('success')): ?>
    <div class="alert alert-success mb-4">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger mb-4">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('register')); ?>" method="POST" class="space-y-4">
    <?php echo csrf_field(); ?>

    <div>
        <label class="block text-sm font-medium">Nama</label>
        <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
            class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-sm font-medium">Email</label>
        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
            class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-sm font-medium">Password</label>
        <input type="password" name="password" required
            class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-sm font-medium">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required
            class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-sm font-medium">Role</label>
        <select name="role" required
            class="w-full mt-1 p-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
            <option value="">-- Pilih Role --</option>
            <option value="admin" <?php echo e(old('role') == 'admin' ? 'selected' : ''); ?>>Admin</option>
            <option value="petugas" <?php echo e(old('role') == 'petugas' ? 'selected' : ''); ?>>Petugas</option>
        </select>
    </div>

    <div>
        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
            Daftar
        </button>
    </div>

    <div class="text-center text-sm text-gray-500">
        Sudah punya akun? <a href="<?php echo e(route('login')); ?>" class="text-blue-600 hover:underline">Login di sini</a>
    </div>
</form>

<?php if(session('success') || session('error')): ?>
<script>
    // Menampilkan alert otomatis
    document.addEventListener('DOMContentLoaded', function() {
        alert("<?php echo e(session('success') ?: session('error')); ?>");
    });
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kasir_19032\resources\views/register.blade.php ENDPATH**/ ?>