

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">
                    <i class="fas fa-cart-plus me-2"></i>Tambahkan Produk untuk <?php echo e($pelanggan->nama); ?>

                </h2>
                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body">
            
            <form method="GET" action="<?php echo e(route('transaksi.pilih_produk', ['pelanggan_id' => $pelanggan->id])); ?>" class="mb-4">
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama produk..." value="<?php echo e(request('search')); ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
            </form>

            
            <form action="<?php echo e(route('transaksi.simpan_produk')); ?>" method="POST" id="transaksi-form">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="pelanggan_id" value="<?php echo e($pelanggan->id); ?>">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th><i class="fas fa-box me-1"></i> Nama Produk</th>
                                <th><i class="fas fa-tag me-1"></i> Harga</th>
                                <th><i class="fas fa-boxes me-1"></i> Stok Tersedia</th>
                                <th><i class="fas fa-layer-group me-1"></i> Jumlah</th>
                                <th><i class="fas fa-check-circle me-1"></i> Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($produk->nama); ?></td>
                                    <td>Rp <?php echo e(number_format($produk->harga, 0, ',', '.')); ?></td>
                                    <td class="<?php echo e($produk->stok <= 0 ? 'text-danger' : ''); ?>">
                                        <?php echo e($produk->stok); ?>

                                        <?php if($produk->stok <= 0): ?>
                                            <span class="badge bg-danger ms-2">Stok Habis</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="width: 120px;">
                                        <input type="number" 
                                               name="jumlah[]" 
                                               class="form-control jumlah" 
                                               min="1" 
                                               max="<?php echo e($produk->stok); ?>" 
                                               value="1"
                                               data-produk-id="<?php echo e($produk->id); ?>"
                                               data-stok="<?php echo e($produk->stok); ?>">
                                        <small class="text-danger stok-error-<?php echo e($produk->id); ?>" style="display:none;">
                                            Stok tidak mencukupi!
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input produk-checkbox" 
                                                   type="checkbox" 
                                                   name="produk_id[]" 
                                                   value="<?php echo e($produk->id); ?>" 
                                                   data-harga="<?php echo e($produk->harga); ?>" 
                                                   style="transform: scale(1.5);"
                                                   <?php echo e($produk->stok <= 0 ? 'disabled' : ''); ?>>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-4 p-3 bg-light rounded">
                    <h3 class="mb-0">
                        <i class="fas fa-receipt me-2"></i>Total Harga: 
                        <span class="text-primary">Rp <span id="total-harga">0</span></span>
                    </h3>
                    <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">
                        <i class="fas fa-save me-2"></i>Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll('.produk-checkbox');
    const totalHargaElement = document.getElementById('total-harga');
    const submitBtn = document.getElementById('submit-btn');
    const transaksiForm = document.getElementById('transaksi-form');
    let hasStockError = false;

    function hitungTotal() {
        let total = 0;
        hasStockError = false;
        
        checkboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                const produkId = checkbox.value;
                const jumlahInput = document.querySelector(`.jumlah[data-produk-id="${produkId}"]`);
                const stok = parseInt(jumlahInput.getAttribute('data-stok'));
                const jumlah = parseInt(jumlahInput.value);
                
                // Validasi stok
                if (jumlah > stok) {
                    document.querySelector(`.stok-error-${produkId}`).style.display = 'block';
                    jumlahInput.classList.add('is-invalid');
                    hasStockError = true;
                } else {
                    document.querySelector(`.stok-error-${produkId}`).style.display = 'none';
                    jumlahInput.classList.remove('is-invalid');
                    
                    let harga = parseFloat(checkbox.getAttribute('data-harga'));
                    total += harga * jumlah;
                }
            }
        });
        
        totalHargaElement.textContent = total.toLocaleString('id-ID');
        submitBtn.disabled = hasStockError;
    }

    checkboxes.forEach(checkbox => checkbox.addEventListener('change', hitungTotal));
    
    document.querySelectorAll('.jumlah').forEach(input => {
        input.addEventListener('input', function() {
            const maxStok = parseInt(this.getAttribute('max'));
            if (parseInt(this.value) > maxStok) {
                this.value = maxStok;
            }
            hitungTotal();
        });
        input.addEventListener('change', hitungTotal);
    });

    // Validasi sebelum submit form
    transaksiForm.addEventListener('submit', function(e) {
        hitungTotal(); // Periksa ulang sebelum submit
        
        if (hasStockError) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Stok Tidak Mencukupi',
                text: 'Beberapa produk melebihi stok yang tersedia. Harap periksa kembali jumlah yang dimasukkan.',
            });
        }
        
        // Jika tidak ada produk yang dipilih
        const checkedBoxes = document.querySelectorAll('.produk-checkbox:checked');
        if (checkedBoxes.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Tidak Ada Produk Dipilih',
                text: 'Silakan pilih minimal satu produk untuk melanjutkan transaksi.',
            });
        }
    });
});
</script>

<style>
    .form-switch .form-check-input {
        cursor: pointer;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    .card {
        border-radius: 10px;
        overflow: hidden;
    }
    .input-group-text {
        border-radius: 0.375rem 0 0 0.375rem;
    }
    .is-invalid {
        border-color: #dc3545;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kasir_19032\resources\views/transaksi/pilih_produk.blade.php ENDPATH**/ ?>