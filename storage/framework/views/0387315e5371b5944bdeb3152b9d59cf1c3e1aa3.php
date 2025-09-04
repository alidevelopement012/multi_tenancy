<?php $__env->startSection('content'); ?>
<div class="page-header">
  <h4 class="page-title"><?php echo e(__('Request Page Texts')); ?></h4>
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
      <a href="#"><?php echo e(__('Custom Domains')); ?></a>
    </li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li class="nav-item">
      <a href="#"><?php echo e(__('Request Page Texts')); ?></a>
    </li>
  </ul>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title d-inline-block"><?php echo e(__('Texts')); ?></div>

      </div>
      <div class="card-body pt-5 pb-5">
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <form id="textsForm" action="<?php echo e(route('admin.custom-domain.texts')); ?>" method="POST">
              <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label><?php echo e(__('Message After Domain Request')); ?> **</label>
                    <textarea name="success_message" rows="3" class="form-control"><?php echo e($abe->domain_request_success_message); ?></textarea>
                    <?php if($errors->has('success_message')): ?>
                        <p class="text-danger mb-0"><?php echo e($errors->first('success_message')); ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label><?php echo e(__('CNAME Record Section Title')); ?> **</label>
                    <input type="text" name="cname_record_section_title" class="form-control" value="<?php echo e($abe->cname_record_section_title); ?>">
                    <?php if($errors->has('cname_record_section_title')): ?>
                        <p class="text-danger mb-0"><?php echo e($errors->first('cname_record_section_title')); ?></p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label><?php echo e(__('CNAME Record Section Text')); ?> **</label>
                    <textarea class="form-control summernote" name="cname_record_section_text" data-height="150" ><?php echo replaceBaseUrl($abe->cname_record_section_text); ?></textarea>
                    <?php if($errors->has('cname_record_section_text')): ?>
                        <p class="text-danger mb-0"><?php echo e($errors->first('cname_record_section_text')); ?></p>
                    <?php endif; ?>
                </div>
            </form>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="form">
          <div class="form-group from-show-notify row">
            <div class="col-12 text-center">
              <button type="submit" form="textsForm" class="btn btn-success"><?php echo e(__('Update')); ?></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/admin/domains/custom-texts.blade.php ENDPATH**/ ?>