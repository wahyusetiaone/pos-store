<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-md-3 mb-3">
    <div class="card h-100 product-card" data-product-id="<?php echo e($product->id); ?>">
        <img src="<?php echo e($product->images->first() ? asset($product->images->first()->image_path) : asset('images/no-image.jpg')); ?>"
             class="card-img-top" alt="<?php echo e($product->name); ?>" style="height: 150px; object-fit: cover;">
        <div class="card-body">
            <h6 class="card-title"><?php echo e($product->name); ?></h6>
            <p class="card-text text-primary">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>,-</p>
            <p class="card-text small">STOK: <?php echo e($product->stock); ?>x</p>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php /**PATH D:\Project\Experiment\pos_app\resources\views/products/partials/product_grid.blade.php ENDPATH**/ ?>