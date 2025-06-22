<?php
    $title = 'Tambah Penjualan';
    $subTitle = 'Form Transaksi Penjualan';
    $script = '<script src="' . asset('assets/js/pages/sale/create.js') . '"></script>';
?>

<?php $__env->startSection('content'); ?>
<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Transaksi Penjualan</h5>
            </div>
            <div class="card-body">
                <form id="saleForm" action="<?php echo e(route('sales.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php if(auth()->user()->hasGlobalAccess()): ?>
                        <div class="mb-3">
                            <label class="form-label">Pilih Toko</label>
                            <select name="store_id" id="store_id" class="form-select <?php $__errorArgs = ['store_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">Pilih Toko...</option>
                                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($store->id); ?>" <?php echo e(old('store_id') == $store->id ? 'selected' : ''); ?>>
                                        <?php echo e($store->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['store_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Pelanggan</label>
                                <select name="customer_id" id="customer_id" class="form-select <?php $__errorArgs = ['customer_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">Pilih Pelanggan...</option>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($customer->id); ?>" data-name="<?php echo e($customer->name); ?>" data-phone="<?php echo e($customer->phone); ?>">
                                            <?php echo e($customer->name); ?> - <?php echo e($customer->phone); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Atau Pelanggan Baru</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="customer_name" class="form-control" placeholder="Nama Pelanggan">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="customer_phone" class="form-control" placeholder="No. Telepon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Selection -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Tambah Produk</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <select id="product_select" class="form-select">
                                        <option value="">Pilih Produk...</option>
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($product->id); ?>"
                                                    data-name="<?php echo e($product->name); ?>"
                                                    data-price="<?php echo e($product->price); ?>"
                                                    data-stock="<?php echo e($product->stock); ?>">
                                                <?php echo e($product->name); ?> (Stok: <?php echo e($product->stock); ?>)
                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" id="qty_input" class="form-control" placeholder="Jumlah" min="1">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" id="price_input" class="form-control" placeholder="Harga" min="0">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" id="discount_input" class="form-control" placeholder="Diskon" min="0" value="0">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary w-100" id="add_item">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th width="100">Jumlah</th>
                                    <th width="150">Harga</th>
                                    <th width="150">Diskon</th>
                                    <th width="150">Subtotal</th>
                                    <th width="50">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="items_table">
                                <!-- Items will be added here dynamically -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Total:</td>
                                    <td colspan="2">
                                        <input type="number" name="total" id="total" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Diskon:</td>
                                    <td colspan="2">
                                        <input type="number" name="discount" id="discount" class="form-control" value="0">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Total Akhir:</td>
                                    <td colspan="2">
                                        <input type="number" name="final_total" id="final_total" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Dibayar:</td>
                                    <td colspan="2">
                                        <input type="number" name="paid" id="paid" class="form-control" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end">Kembalian:</td>
                                    <td colspan="2">
                                        <input type="number" name="change" id="change" class="form-control" readonly>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Metode Pembayaran</label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="cash">Tunai</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="card">Kartu Debit/Kredit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea name="note" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="<?php echo e(route('sales.index')); ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Experiment\pos_app\resources\views/sales/create.blade.php ENDPATH**/ ?>