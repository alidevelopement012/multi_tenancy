
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/all.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/fontawesome-iconpicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/dropzone.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap-tagsinput.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/jquery-ui.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/jquery.timepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/atlantis.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/custom.css')); ?>">
<?php if(request()->cookie('admin-theme') == 'dark'): ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/dark.css')); ?>">
<?php endif; ?>

<?php echo $__env->yieldContent('styles'); ?>
<?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/installable/resources/views/admin/partials/styles.blade.php ENDPATH**/ ?>