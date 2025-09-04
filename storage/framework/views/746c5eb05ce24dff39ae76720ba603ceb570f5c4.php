<?php $__env->startSection('pagename'); ?>
    - <?php echo e(__('Success')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-title'); ?>
    <?php echo e(__('Success')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-link'); ?>
    <?php echo e(__('Success')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container ptb-120">
    <div class="row align-items-center gx-xl-5">
        <div class="col-md-6 mx-auto">
            <div class="payment-img mb-30">
                <img src="<?php echo e(asset('assets/front/images/success.svg')); ?>" alt="Success Illustration">
            </div>
        </div>
        <div class="col-md-6 mx-auto" id="mt">
            <div class="payment mb-30">
                <div class="content">
                    <h2 class="mb-4"><?php echo e(__('trial_success')); ?></h2>
                    <p class="paragraph-text mb-4">
                        <?php echo e(__('trial_success_msg')); ?>

                    </p>
                    <a href="<?php echo e(route('front.index')); ?>" class="btn primary-btn"><?php echo e(__('Go To Home')); ?></a>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/front/trial-success.blade.php ENDPATH**/ ?>