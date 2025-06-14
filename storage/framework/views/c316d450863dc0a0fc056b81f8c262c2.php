<?php
    $title = 'Daftar Penjualan';
    $subTitle = 'Tabel Penjualan';
?>

<?php $__env->startSection('content'); ?>
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="<?php echo e(route('sales.create')); ?>" class="btn btn-primary float-end">Tambah Penjualan</a>
            </div>
            <div class="card-body">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Diskon</th>
                                <th>Dibayar</th>
                                <th>Metode</th>
                                <th>User</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($sale->sale_date); ?></td>
                                    <td><?php echo e($sale->customer->name ?? '-'); ?></td>
                                    <td>Rp <?php echo e(number_format($sale->total, 0, ',', '.')); ?></td>
                                    <td>Rp <?php echo e(number_format($sale->discount, 0, ',', '.')); ?></td>
                                    <td>Rp <?php echo e(number_format($sale->paid, 0, ',', '.')); ?></td>
                                    <td><?php echo e(ucfirst($sale->payment_method)); ?></td>
                                    <td><?php echo e($sale->user->name ?? '-'); ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('sales.show', $sale->id)); ?>" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center me-1" title="Lihat">
                                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                        </a>
                                        <a href="<?php echo e(route('sales.edit', $sale->id)); ?>" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center me-1" title="Ubah">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>
                                        <form action="<?php echo e(route('sales.destroy', $sale->id)); ?>" method="POST" style="display:inline-block;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0" onclick="return confirm('Hapus penjualan ini?')" title="Hapus">
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
                    <?php if($sales->hasPages()): ?>
                        <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                            <li class="page-item">
                                <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px"
                                   href="<?php echo e($sales->previousPageUrl() ?? 'javascript:void(0)'); ?>" <?php if($sales->onFirstPage()): ?> tabindex="-1" aria-disabled="true" <?php endif; ?>>
                                    <iconify-icon icon="ep:d-arrow-left" class="text-xl"></iconify-icon>
                                </a>
                            </li>
                            <?php $__currentLoopData = $sales->getUrlRange(1, $sales->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="page-item">
                                    <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px<?php echo e($page == $sales->currentPage() ? ' bg-primary-600 text-white' : ''); ?>"
                                       href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <li class="page-item">
                                <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-8 border-0 px-20 py-10 d-flex align-items-center justify-content-center h-48-px w-48-px"
                                   href="<?php echo e($sales->nextPageUrl() ?? 'javascript:void(0)'); ?>" <?php if(!$sales->hasMorePages()): ?> tabindex="-1" aria-disabled="true" <?php endif; ?>>
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


<?php echo $__env->make('layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Experiment\pos_app\resources\views/sales/index.blade.php ENDPATH**/ ?>