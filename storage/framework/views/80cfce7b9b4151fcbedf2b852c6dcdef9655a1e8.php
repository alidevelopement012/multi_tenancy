<?php $__env->startSection('template_title'); ?>
    <?php echo e(trans('installer_messages.final.templateTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <i class="fa fa-thumbs-up fa-fw" aria-hidden="true"></i>
    <?php echo e(trans('installer_messages.final.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

	<p><strong><small><?php echo e(trans('installer_messages.final.console')); ?></small></strong></p>
	<pre><code><?php echo e($finalMessages); ?></code></pre>

	<p><strong><small><?php echo e(trans('installer_messages.final.log')); ?></small></strong></p>
	<pre><code><?php echo e($finalStatusMessage); ?></code></pre>


    <blockquote>
        <p><strong>Admin Panel Information</strong></p>
        <strong>URL: </strong>{your_website_url}/admin <br>
        <strong>Username: </strong>admin <br>
        <strong>Password: </strong>admin
    </blockquote>

	<p><strong><small><?php echo e(trans('installer_messages.final.env')); ?></small></strong></p>
	<pre><code><?php echo e($finalEnvFile); ?></code></pre>

    <div class="buttons">
        <a href="<?php echo e(url('/')); ?>" class="button"><?php echo e(trans('installer_messages.final.exit')); ?></a>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/installable/resources/views/vendor/installer/finished.blade.php ENDPATH**/ ?>