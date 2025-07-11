

<?php
    $title='404';
    $subTitle = 'Components / 404';
?>

<?php $__env->startSection('content'); ?>

            <div class="card basic-data-table">
                <div class="card-body py-80 px-32 text-center">
                    <img src="<?php echo e(asset('assets/images/error-img.png')); ?>" alt="" class="mb-24">
                    <h6 class="mb-16">Page not Found</h6>
                    <p class="text-secondary-light">Sorry, the page you are looking for doesn't exist </p>
                    <a href="<?php echo e(route('index')); ?>" class="btn btn-primary-600 radius-8 px-20 py-11">Back to Home</a>
                </div>
            </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Laravel\wowdash - 2\resources\views/error.blade.php ENDPATH**/ ?>