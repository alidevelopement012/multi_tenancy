<?php $__env->startSection('pagename'); ?>
 - <?php echo e(__('Edit Profile')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Profile')); ?></h4>
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
        <a href="#"><?php echo e(__('Profile')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title"><?php echo e(__('Update Profile')); ?></div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 offset-lg-3">
               <form action="<?php echo e(route('admin.update.profile')); ?>" method="post" role="form" enctype="multipart/form-data">
                 <?php echo csrf_field(); ?>
                 <div class="form-body">
                    <div class="form-group">
                        <div class="col-12 mb-2">
                          <label for="image"><strong><?php echo e(__('Profile Image')); ?></strong></label>
                        </div>
                        <div class="col-md-12 showImage mb-3">
                          <img src="<?php echo e(!empty(Auth::guard('admin')->user()->image) ? asset('assets/admin/img/propics/'.Auth::guard('admin')->user()->image) : asset('assets/admin/img/noimage.jpg')); ?>" alt="..." class="img-thumbnail">
                        </div>
                        <input type="file" name="profile_image" id="image" class="form-control image">
                        <?php if($errors->has('profile_image')): ?>
                            <p class="text-danger mb-0"><?php echo e($errors->first('profile_image')); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                          <label><?php echo e(__('Username')); ?></label>
                        </div>
                       <div class="col-md-12">
                          <input class="form-control input-lg" name="username" value="<?php echo e($admin->username); ?>" placeholder="<?php echo e(__('Your Username')); ?>" type="text">
                          <?php if($errors->has('username')): ?>
                            <p class="text-danger mb-0"><?php echo e($errors->first('username')); ?></p>
                          <?php endif; ?>
                       </div>
                    </div>
                     <div class="form-group">
                         <div class="col-md-12">
                           <label><?php echo e(__('Email')); ?></label>
                         </div>
                        <div class="col-md-12">
                           <input class="form-control input-lg" name="email" value="<?php echo e($admin->email); ?>" placeholder="<?php echo e(__("Your Email")); ?>" type="text">
                           <?php if($errors->has('email')): ?>
                             <p class="text-danger mb-0"><?php echo e($errors->first('email')); ?></p>
                           <?php endif; ?>
                        </div>
                     </div>
                    <div class="form-group">
                        <div class="col-md-12">
                          <label><?php echo e(__('First Name')); ?></label>
                        </div>
                       <div class="col-md-12">
                          <input class="form-control input-lg" name="first_name" value="<?php echo e($admin->first_name); ?>" placeholder="<?php echo e(__('Your First Name')); ?>" type="text">
                          <?php if($errors->has('first_name')): ?>
                            <p class="text-danger mb-0"><?php echo e($errors->first('first_name')); ?></p>
                          <?php endif; ?>
                       </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                       <label><?php echo e(__('Last Name')); ?></label>
                      </div>
                       <div class="col-md-12">
                          <input class="form-control input-lg" name="last_name" value="<?php echo e($admin->last_name); ?>" placeholder="<?php echo e(__('Your Last Name')); ?>" type="last_name">
                          <?php if($errors->has('last_name')): ?>
                            <p class="text-danger mb-0"><?php echo e($errors->first('last_name')); ?></p>
                          <?php endif; ?>
                       </div>
                    </div>
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

      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/admin/profile/editprofile.blade.php ENDPATH**/ ?>