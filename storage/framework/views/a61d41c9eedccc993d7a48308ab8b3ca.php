<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="<?php echo e(route('index')); ?>" class="sidebar-logo">
            <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="site logo" class="light-logo">
            <img src="<?php echo e(asset('assets/images/logo-light.png')); ?>" alt="site logo" class="dark-logo">
            <img src="<?php echo e(asset('assets/images/logo-icon.png')); ?>" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="<?php echo e(route('index')); ?>">
                    <iconify-icon icon="solar:home-2-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'cashier'): ?>
            <li class="sidebar-menu-group-title">POS</li>
            <li>
                <a href="<?php echo e(route('pos')); ?>">
                    <iconify-icon icon="solar:home-2-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard POS</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'purchase'): ?>
            <li>
                <a href="<?php echo e(route('products.index')); ?>">
                    <iconify-icon icon="mdi:package-variant" class="menu-icon"></iconify-icon>
                    <span>Produk</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('categories.index')); ?>">
                    <iconify-icon icon="mdi:shape-outline" class="menu-icon"></iconify-icon>
                    <span>Kategori</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'cashier'): ?>
            <li>
                <a href="<?php echo e(route('customers.index')); ?>">
                    <iconify-icon icon="mdi:account-group-outline" class="menu-icon"></iconify-icon>
                    <span>Pelanggan</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('sales.index')); ?>">
                    <iconify-icon icon="mdi:cart-outline" class="menu-icon"></iconify-icon>
                    <span>Penjualan</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'purchase'): ?>
            <li>
                <a href="<?php echo e(route('purchases.index')); ?>">
                    <iconify-icon icon="mdi:truck-outline" class="menu-icon"></iconify-icon>
                    <span>Pembelian</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('finances.index')); ?>">
                    <iconify-icon icon="mdi:cash-multiple" class="menu-icon"></iconify-icon>
                    <span>Keuangan</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if(auth()->user()->role === 'admin'): ?>
            <li>
                <a href="<?php echo e(route('users.index')); ?>">
                    <iconify-icon icon="mdi:account-key-outline" class="menu-icon"></iconify-icon>
                    <span>Pengguna</span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</aside>
<?php /**PATH D:\Project\Experiment\pos_app\resources\views/components/sidebar.blade.php ENDPATH**/ ?>