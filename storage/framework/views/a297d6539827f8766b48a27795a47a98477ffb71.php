<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h4 class="page-title"><?php echo e(empty(request()->input('type')) ? 'All' : ucfirst(request()->input('type'))); ?> <?php echo e(__('Subdomains')); ?></h4>
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
                <a href="#"><?php echo e(__('Subdomains')); ?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#"><?php echo e(empty(request()->input('type')) ? 'All' : ucfirst(request()->input('type'))); ?></a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card-title d-inline-block"><?php echo e(__('All Subdomains')); ?></div>
                        </div>
                        <div class="col-lg-6 offset-lg-2 mt-2 mt-lg-0">
                            <form action="<?php echo e(request()->url()); ?>" class="float-right d-flex">
                                <?php if(!empty(request()->input('type'))): ?>
                                    <input type="hidden" name="type" value="<?php echo e(request()->input('type')); ?>">
                                <?php endif; ?>
                                <input name="username" class="min-w-250 form-control mr-2" type="text"
                                       placeholder="Search by Username" value="<?php echo e(request()->input('username')); ?>">
                                <button type="submit" class="d-none"></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(count($subdomains) == 0): ?>
                                <h3 class="text-center"><?php echo e(__('NO SUBDOMAIN FOUND')); ?></h3>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped mt-3">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(__('Username')); ?></th>
                                            <th><?php echo e(__('Subdomain')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $subdomains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subdomain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($subdomain->username); ?></td>
                                                <td>
                                                    <span><?php echo e(strtolower($subdomain->username)); ?>.<?php echo e(env('WEBSITE_HOST')); ?></span>
                                                </td>
                                                <td width="10%">
                                                    <form id="statusForm<?php echo e($subdomain->id); ?>"
                                                          action="<?php echo e(route('admin.subdomain.status')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="user_id" value="<?php echo e($subdomain->id); ?>">
                                                        <select class="max-w-130 form-control form-control-sm
                                                            <?php if($subdomain->subdomain_status == 0): ?>
                                                                bg-warning text-white
                                                            <?php elseif($subdomain->subdomain_status == 1): ?>
                                                                bg-success text-white
                                                            <?php endif; ?>
                                                                " name="status"
                                                            onchange="document.getElementById('statusForm<?php echo e($subdomain->id); ?>').submit();">
                                                            <option
                                                                value="0" <?php echo e($subdomain->subdomain_status == 0 ? 'selected' : ''); ?>>
                                                                <?php echo e(__('Pending')); ?>

                                                            </option>
                                                            <option
                                                                value="1" <?php echo e($subdomain->subdomain_status == 1 ? 'selected' : ''); ?>>
                                                                <?php echo e(__('Connected')); ?>

                                                            </option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <button class="btn btn-secondary btn-sm editbtn" data-toggle="modal"
                                                            data-target="#mailModal" data-email="<?php echo e($subdomain->email); ?>">
                                                        <?php echo e(__('Mail')); ?>

                                                    </button>
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
                    <?php echo e($subdomains->appends(['type' => request()->input('type'), 'username' => request()->input('username')])->links()); ?>

                </div>


             
                <div class="modal fade" id="mailModal" data-focus="false" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo e(__('Send Mail')); ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="ajaxEditForm" class="" action="<?php echo e(route('admin.custom-domain.mail')); ?>"
                                      method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Email Address')); ?> **</label>
                                        <input id="inemail" type="text" class="form-control" name="email" value="" placeholder="<?php echo e(__('Enter email')); ?>">
                                        <p id="eerremail" class="mb-0 text-danger em"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Subject')); ?> **</label>
                                        <input id="insubject" type="text" class="form-control" name="subject" value="" placeholder="<?php echo e(__('Enter subject')); ?>">
                                        <p id="eerrsubject" class="mb-0 text-danger em"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for=""><?php echo e(__('Message')); ?> **</label>
                                        <textarea id="inmessage" class="form-control summernote" name="message"
                                                  placeholder="<?php echo e(__('Enter message')); ?>" data-height="150"></textarea>
                                        <p id="eerrmessage" class="mb-0 text-danger em"></p>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                <button id="updateBtn" type="button" class="btn btn-primary"><?php echo e(__('Send Mail')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/admin/subdomains/index.blade.php ENDPATH**/ ?>