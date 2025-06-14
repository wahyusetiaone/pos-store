<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<?php if (isset($component)) { $__componentOriginal0f509fab02c45445826003a1e50db506 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f509fab02c45445826003a1e50db506 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.head','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f509fab02c45445826003a1e50db506)): ?>
<?php $attributes = $__attributesOriginal0f509fab02c45445826003a1e50db506; ?>
<?php unset($__attributesOriginal0f509fab02c45445826003a1e50db506); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f509fab02c45445826003a1e50db506)): ?>
<?php $component = $__componentOriginal0f509fab02c45445826003a1e50db506; ?>
<?php unset($__componentOriginal0f509fab02c45445826003a1e50db506); ?>
<?php endif; ?>

<body>

    <div class="custom-bg">
        <div class="container container--xl">
            <div class="d-flex align-items-center justify-content-between py-24">
                <a href="<?php echo e(route('index')); ?>" class="">
                    <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="">
                </a>
                <a href="<?php echo e(route('index')); ?>" class="btn btn-outline-primary-600 text-sm"> Go To Home </a>
            </div>

            <div class="py-res-120">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="mb-32 max-w-1000-px">Our site is under maintenance. Please keep patience.</h3>
                        <p class="text-neutral-500 max-w-700-px text-lg">We have been spending extended periods to send off our new site. Join our mailing list or follow us on Facebook for get most recent update.</p>
                        <div class="mt-56 max-w-500-px text-start">
                            <span class="fw-semibold text-neutral-600 text-lg text-hover-neutral-600"> Do you want to get update? Please subscribe now</span>
                            <form action="#" class="mt-16 d-flex gap-16 flex-sm-row flex-column">
                                <input type="email" class="form-control text-start py-24 flex-grow-1" placeholder="wowdash@gmail.com" required>
                                <button type="submit" class="btn btn-primary-600 px-24 flex-shrink-0 d-flex align-items-center justify-content-center gap-8">
                                    <i class="ri-notification-2-line"></i> Knock Us
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-6 d-lg-block d-none">
                        <img src="<?php echo e(asset('assets/images/coming-soon/maintenance.png')); ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php if (isset($component)) { $__componentOriginal2a2e30ee7946b5afacadfde3b701b26e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a2e30ee7946b5afacadfde3b701b26e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.script','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('script'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2a2e30ee7946b5afacadfde3b701b26e)): ?>
<?php $attributes = $__attributesOriginal2a2e30ee7946b5afacadfde3b701b26e; ?>
<?php unset($__attributesOriginal2a2e30ee7946b5afacadfde3b701b26e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2a2e30ee7946b5afacadfde3b701b26e)): ?>
<?php $component = $__componentOriginal2a2e30ee7946b5afacadfde3b701b26e; ?>
<?php unset($__componentOriginal2a2e30ee7946b5afacadfde3b701b26e); ?>
<?php endif; ?>

</body>

</html><?php /**PATH E:\Laravel\wowdash - 2\resources\views/maintenance.blade.php ENDPATH**/ ?>