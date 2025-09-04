<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Subscribers')); ?></h4>
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
        <a href="#"><?php echo e(__('Subscribers')); ?></a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Subscribers')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <div class="card-title d-inline-block"><?php echo e(__('Subscribers')); ?></div>
                </div>
                <div class="col-6 mt-2 mt-lg-0">
                    <button class="btn btn-danger float-right btn-sm ml-2 mt-1 d-none bulk-delete" data-href="<?php echo e(route('admin.subscriber.bulk.delete')); ?>"><i class="flaticon-interface-5"></i> <?php echo e(__('Delete')); ?></button>
                    <form action="<?php echo e(url()->full()); ?>" class="float-right">
                        <input type="text" name="term" class="form-control" value="<?php echo e(request()->input('term')); ?>" placeholder="Search by Email">
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <?php if(count($subscs) == 0): ?>
                <h3 class="text-center"><?php echo e(__('NO SUBSCRIBER FOUND')); ?></h3>
              <?php else: ?>
                <div class="table-responsive">
                  <table class="table table-striped mt-3">
                    <thead>
                      <tr>
                        <th scope="col">
                            <input type="checkbox" class="bulk-check" data-val="all">
                        </th>
                        <th scope="col"><?php echo e(__('Email')); ?></th>
                        <th scope="col"><?php echo e(__('Action')); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $subscs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subsc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td>
                            <input type="checkbox" class="bulk-check" data-val="<?php echo e($subsc->id); ?>">
                          </td>
                          <td><?php echo e($subsc->email); ?></td>
                          <td>
                            <form class="deleteform d-inline-block" action="<?php echo e(route('admin.subscriber.delete')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="subscriber_id" value="<?php echo e($subsc->id); ?>">
                                <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                <span class="btn-label">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <?php echo e(__('Delete')); ?>

                                </button>
                            </form>
                           </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card-footer">
            <div class="row">
              <div class="d-inline-block mx-auto">
                <?php echo e($subscs->appends(['term' => request()->input('term')])->links()); ?>

              </div>
            </div>
        </div>

      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/installable/resources/views/admin/subscribers/index.blade.php ENDPATH**/ ?>