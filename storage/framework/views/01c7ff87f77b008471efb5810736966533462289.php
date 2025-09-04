<?php $__env->startSection('pagename'); ?>
    - <?php echo e(__('Change Password')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Password')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="#">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Profile Settings')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Password')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <form action="<?php echo e(route('admin.update.password')); ?>" method="post" role="form">
          <div class="card-header">
            <div class="card-title"><?php echo e(__('Update Password')); ?></div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 offset-lg-3">
                <?php echo csrf_field(); ?>
                 <div class="form-body">
                    <div class="form-group">
                       <label><?php echo e(__('Current Password')); ?></label>
                       <div class="">
                          <input class="form-control" name="old_password" placeholder="<?php echo e(__('Your Current Password')); ?>" type="password">
                          <?php if($errors->has('old_password')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('old_password')); ?>

                          </span>
                          <?php else: ?>
                          <?php if($errors->first('oldPassMatch')): ?>
                          <span class="text-danger">
                              <?php echo e("Old password doesn't match with the existing password!"); ?>

                          </span>
                          <?php endif; ?>
                          <?php endif; ?>
                       </div>
                    </div>
                    <div class="form-group">
                       <label><?php echo e(__('New Password')); ?></label>
                       <div class="">
                          <input class="form-control" name="password" placeholder="<?php echo e(__('New Password')); ?>" type="password">
                          <?php if($errors->has('password')): ?>
                          <span class="text-danger">
                              <?php echo e($errors->first('password')); ?>

                          </span>
                          <?php endif; ?>
                       </div>
                    </div>
                    <div class="form-group">
                       <label><?php echo e(__('New Password Again')); ?></label>
                       <div class="">
                          <input class="form-control" name="password_confirmation" placeholder="<?php echo e(__('New Password Again')); ?>" type="password">
                       </div>
                    </div>
                 </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
               <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-success"><?php echo e(__('Submit')); ?></button>
               </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/admin/profile/changepassword.blade.php ENDPATH**/ ?>