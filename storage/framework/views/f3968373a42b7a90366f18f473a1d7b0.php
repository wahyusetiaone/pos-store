<?php
    $title = 'Daftar Produk';
    $subTitle = 'Tabel Produk';
?>

<?php $__env->startSection('content'); ?>
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="<?php echo e(route('products.index')); ?>" class="row g-2 align-items-center">
                    <div class="col-auto">
                        <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?php echo e(request('search')); ?>">
                    </div>
                    <div class="col-auto">
                        <select name="category_id" class="form-control">
                            <option value="">Semua Kategori</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                    <div class="col-auto ms-auto">
                        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-success">Tambah Produk</a>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <?php if(auth()->user()->hasGlobalAccess()): ?>
                                    <th>Nama Toko</th>
                                <?php endif; ?>
                                <th>SKU</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Barcode</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(($products->currentPage() - 1) * $products->perPage() + $loop->iteration); ?></td>
                                <?php if(auth()->user()->hasGlobalAccess()): ?>
                                    <td><?php echo e($product->store->name ?? '-'); ?></td>
                                <?php endif; ?>
                                <td><?php echo e($product->sku); ?></td>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e($product->category->name ?? '-'); ?></td>
                                <td>
                                    <img src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($product->sku, 'C128', 1.2, 40)); ?>" alt="Barcode" style="max-width:120px; max-height:40px;">
                                </td>
                                <td>Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></td>
                                <td><?php echo e($product->stock); ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('products.show', $product->id)); ?>" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center me-1" title="Lihat">
                                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                    </a>
                                    <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center me-1" title="Ubah">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>
                                    <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" style="display:inline-block;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0" onclick="return confirm('Hapus produk ini?')" title="Hapus">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <?php if($products->hasPages()): ?>
                        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                            <li class="page-item">
                                <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px"
                                   href="<?php echo e($products->previousPageUrl() ?? 'javascript:void(0)'); ?>" <?php if($products->onFirstPage()): ?> tabindex="-1" aria-disabled="true" <?php endif; ?>>
                                    <iconify-icon icon="ep:d-arrow-left" class="text-xl"></iconify-icon>
                                </a>
                            </li>
                            <?php $__currentLoopData = $products->getUrlRange(1, $products->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="page-item">
                                    <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px<?php echo e($page == $products->currentPage() ? ' bg-primary-600 text-white' : ''); ?>"
                                       href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li class="page-item">
                                <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px"
                                   href="<?php echo e($products->nextPageUrl() ?? 'javascript:void(0)'); ?>" <?php if(!$products->hasMorePages()): ?> tabindex="-1" aria-disabled="true" <?php endif; ?>>
                                    <iconify-icon icon="ep:d-arrow-right" class="text-xl"></iconify-icon>
                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Experiment\pos_app\resources\views/products/index.blade.php ENDPATH**/ ?>