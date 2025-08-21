

<?php $__env->startSection('title', 'Beranda'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <!-- Welcome Header with Animation -->
        <div class="row mb-5 animate__animated animate__fadeIn">
            <div class="col-12">
                <div class="card shadow-sm border-0 overflow-hidden">
                    <div class="card-body p-5 text-center position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
                            <div class="shape-1 position-absolute bg-primary rounded-circle" style="width: 150px; height: 150px; top: -50px; left: -50px;"></div>
                            <div class="shape-2 position-absolute bg-success rounded-circle" style="width: 200px; height: 200px; bottom: -100px; right: -100px;"></div>
                        </div>
                        <h1 class="display-4 fw-bold text-gradient-primary animate__animated animate__fadeInDown">Selamat Datang di KasirApp</h1>
                        <p class="lead text-muted animate__animated animate__fadeIn animate__delay-1s">Silakan pilih menu di sidebar atau tombol di bawah untuk memulai</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Cards with Staggered Animation -->
        <div class="row g-4">
            <!-- Produk Card -->
            <div class="col-md-4 animate__animated animate__fadeInLeft">
                <div class="card card-hover border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="icon-lg bg-primary bg-gradient rounded-circle text-white mb-4 mx-auto animate__animated animate__bounceIn animate__delay-1s">
                            <i class="fas fa-cubes"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Kelola Produk</h3>
                        <p class="text-muted mb-4">Tambah, edit, atau hapus produk dari inventaris Anda</p>
                        <a href="<?php echo e(url('produk')); ?>" class="btn btn-primary px-4 btn-hover-scale">
                            <i class="fas fa-arrow-right me-2"></i> Masuk
                        </a>
                    </div>
                </div>
            </div>

            <!-- Transaksi Card -->
            <div class="col-md-4 animate__animated animate__fadeInUp">
                <div class="card card-hover border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="icon-lg bg-success bg-gradient rounded-circle text-white mb-4 mx-auto animate__animated animate__bounceIn animate__delay-1-5s">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Transaksi</h3>
                        <p class="text-muted mb-4">Buat transaksi baru atau lihat riwayat transaksi</p>
                        <a href="<?php echo e(url('transaksi')); ?>" class="btn btn-success px-4 btn-hover-scale">
                            <i class="fas fa-arrow-right me-2"></i> Masuk
                        </a>
                    </div>
                </div>
            </div>

            <!-- Laporan Card -->
            <div class="col-md-4 animate__animated animate__fadeInRight">
                <div class="card card-hover border-0 shadow-sm h-100">
                    <div class="card-body p-4 text-center">
                        <div class="icon-lg bg-info bg-gradient rounded-circle text-white mb-4 mx-auto animate__animated animate__bounceIn animate__delay-2s">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h3 class="h5 fw-bold mb-3">Laporan</h3>
                        <p class="text-muted mb-4">Analisis penjualan dan kinerja bisnis Anda</p>
                        <a href="<?php echo e(url('laporan')); ?>" class="btn btn-info px-4 text-white btn-hover-scale">
                            <i class="fas fa-arrow-right me-2"></i> Masuk
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section with List Animation -->
        <div class="row mt-5 animate__animated animate__fadeIn animate__delay-1s">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-bell me-2"></i> Aktivitas Terbaru</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <?php $__empty_1 = true; $__currentLoopData = $latestActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="list-group-item border-0 py-3 animate__animated animate__fadeInUp" style="animation-delay: <?php echo e($index * 0.1); ?>s">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <?php if($activity['type'] === 'transaction'): ?>
                                        <i class="fas fa-receipt text-primary"></i>
                                        <?php else: ?>
                                        <i class="fas fa-box text-success"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <h6 class="mb-1"><?php echo e($activity['message']); ?></h6>
                                        <small class="text-muted"><?php echo e($activity['time']); ?></small>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="list-group-item border-0 py-3 text-center text-muted animate__animated animate__fadeIn">
                                Belum ada aktivitas terbaru
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-gradient-primary {
            background: linear-gradient(to right, #4361ee, #3a0ca3);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .card-hover {
            transition: all 0.3s ease;
            border-radius: 10px;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .btn-hover-scale {
            transition: all 0.2s ease;
        }
        
        .btn-hover-scale:hover {
            transform: scale(1.05);
        }
        
        .icon-lg {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .card-hover:hover .icon-lg {
            transform: rotate(10deg) scale(1.1);
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }
        
        .floating {
            animation: float 3s ease-in-out infinite;
        }
    </style>

    <?php $__env->startPush('scripts'); ?>
    <!-- Animate.css for smooth animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effect to cards
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.classList.add('shadow-lg');
                });
                card.addEventListener('mouseleave', function() {
                    this.classList.remove('shadow-lg');
                });
            });
            
            // Make the welcome icon float continuously
            const welcomeIcon = document.querySelector('.welcome-icon');
            if (welcomeIcon) {
                welcomeIcon.classList.add('floating');
            }
            
            // Animate activity items when they come into view
            const activityItems = document.querySelectorAll('.list-group-item');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__fadeInUp');
                    }
                });
            }, { threshold: 0.1 });
            
            activityItems.forEach(item => {
                observer.observe(item);
            });
        });
    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\kasir_19032\resources\views/home.blade.php ENDPATH**/ ?>