<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title"><?php echo e(__('Edit Tenant')); ?></h4>
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
                <a href="#"><?php echo e(__('Tenant Management')); ?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?php echo e(__('Edit Tenant')); ?></a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title d-inline-block"><?php echo e(__('Edit Tenant')); ?></div>
                    <a class="btn btn-info btn-sm float-right d-inline-block" href="<?php echo e(route('admin.tenant.index')); ?>">
            <span class="btn-label">
              <i class="fas fa-backward"></i>
            </span>
                        <?php echo e(__('Back')); ?>

                    </a>
                </div>
                <div class="card-body pt-5 pb-5">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">

                            <form id="ajaxForm" class="" action="<?php echo e(route('admin.tenant.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for=""><?php echo e(__('Username')); ?> **</label>
                                            <input type="text" class="form-control" name="username" placeholder="<?php echo e(__('Enter username')); ?>" value="<?php echo e($user->username); ?>">
                                            <p id="errusername" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for=""><?php echo e(__('Email')); ?> **</label>
                                            <input type="text" class="form-control" name="email" placeholder="<?php echo e(__('Enter email')); ?>" value="<?php echo e($user->email); ?>">
                                            <p id="erremail" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for=""><?php echo e(__('First Name')); ?> **</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="<?php echo e(__('Enter first name')); ?>" value="<?php echo e($user->first_name); ?>">
                                            <p id="errfirst_name" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for=""><?php echo e(__('Last Name')); ?> **</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="<?php echo e(__('Enter last name')); ?>" value="<?php echo e($user->last_name); ?>">
                                            <p id="errlast_name" class="mb-0 text-danger em"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for=""><?php echo e(__('Status')); ?> **</label>
                                            <select class="form-control" name="status">
                                                <option value="" selected disabled><?php echo e(__('Select a status')); ?></option>
                                                <option value="1" <?php echo e($user->status == 1 ? 'selected' : ''); ?>><?php echo e(__('Active')); ?></option>
                                                <option value="0" <?php echo e($user->status == 0 ? 'selected' : ''); ?>><?php echo e(__('Deactive')); ?></option>
                                            </select>
                                            <p id="errstatus" class="mb-0 text-danger em"></p>
                                        </div>
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
                                <button type="submit" id="submitBtn" class="btn btn-success"><?php echo e(__('Update')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/admin/tenants/edit.blade.php ENDPATH**/ ?>