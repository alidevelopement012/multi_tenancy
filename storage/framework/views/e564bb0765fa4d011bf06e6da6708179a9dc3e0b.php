<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Roles')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e($role->name); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Permissions Management')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <div class="card-title d-inline-block"><?php echo e(__('Permissions Management')); ?></div>
          <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('admin.role.index')); ?>">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
            <?php echo e(__('Back')); ?>

          </a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-8 offset-lg-2">
              <form id="permissionsForm" class="" action="<?php echo e(route('admin.role.permissions.update')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="role_id" value="<?php echo e(Request::route('id')); ?>">

                <?php
                  $permissions = $role->permissions;
                  if (!empty($role->permissions)) {
                    $permissions = json_decode($permissions, true);
                  }
                ?>

                <div class="form-group">
                  <label for=""><?php echo e(__('Permissions')); ?>: </label>
                	<div class="selectgroup selectgroup-pills mt-2">
                		<label class="selectgroup-item">
                			<input type="hidden" name="permissions[]" value="Dashboard" class="selectgroup-input">
                		</label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="permissions[]" value="Packages"
                                   class="selectgroup-input" <?php if(is_array($permissions) && in_array('Packages',
											$permissions)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Package Management')); ?></span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="checkbox" name="permissions[]" value="Payment Log"
                                   class="selectgroup-input" <?php if(is_array($permissions) && in_array('Payment Log',
											$permissions)): ?> checked <?php endif; ?>>
                            <span class="selectgroup-button"><?php echo e(__('Payment Log')); ?></span>
                        </label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Menu Builder" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Menu Builder', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Menu Builder')); ?></span>
                        </label>

                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Home Page" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Home Page', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Home Page')); ?></span>
                        </label>

						<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Footer" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Footer', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Footer')); ?></span>
                		</label>

                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Pages" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Pages', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Pages')); ?></span>
                		</label>

                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Blogs" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Blogs', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Blog')); ?></span>
                		</label>


                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="FAQ Management" class="selectgroup-input" <?php if(is_array($permissions) && in_array('FAQ Management', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('FAQ Management')); ?></span>
                		</label>

                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Contact Page" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Contact Page', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Contact Page')); ?></span>
                		</label>

                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Announcement Popup" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Announcement Popup', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Announcement Popup')); ?></span>
                		</label>

                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Registered Users" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Registered Users', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Registered Users')); ?></span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Subscribers" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Subscribers', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Subscribers')); ?></span>
                        </label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Payment Gateways" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Payment Gateways', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Payment Gateways')); ?></span>
                		</label>

                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Settings" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Settings', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Settings')); ?></span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Language Management" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Language Management', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Language Management')); ?></span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Role Management" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Role Management', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Role Management')); ?></span>
                		</label>
                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Admins Management" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Admins Management', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Admins Management')); ?></span>
                		</label>

                		<label class="selectgroup-item">
                			<input type="checkbox" name="permissions[]" value="Sitemap" class="selectgroup-input" <?php if(is_array($permissions) && in_array('Sitemap', $permissions)): ?> checked <?php endif; ?>>
                			<span class="selectgroup-button"><?php echo e(__('Sitemap')); ?></span>
                        </label>
                	</div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="form">
            <div class="form-group from-show-notify row">
              <div class="col-12 text-center">
                <button type="submit" id="permissionBtn" class="btn btn-success"><?php echo e(__('Update')); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/admin/role/permission/manage.blade.php ENDPATH**/ ?>