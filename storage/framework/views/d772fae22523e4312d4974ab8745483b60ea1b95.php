<?php $__env->startSection('pagename'); ?>
    - <?php echo e(__('Listings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta-description', !empty($seo) ? $seo->profiles_meta_description : ''); ?>
<?php $__env->startSection('meta-keywords', !empty($seo) ? $seo->profiles_meta_keywords : ''); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <?php echo e(__('Listings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-link'); ?>
    <?php echo e(__('Listings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="user-profile-area ptb-120 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="search-filter mb-5">
                <form action="<?php echo e(route('front.user.view')); ?>">
                    <div class="row align-items-center">
                        <div class="col-lg-5">
                            <div class="search-box mt-2">
                                <input type="text" class="form-control" placeholder="<?php echo e(__('Search by resturant name')); ?>" name="resturant">
                            </div>
                        </div>
                        <div class="col-lg-5 ">
                            <div class="search-box mt-2">
                                <input type="text" class="form-control" placeholder="<?php echo e(__('Search by location')); ?>" name="location">
                            </div>
                        </div>
                        <div class="col-lg-2  ">
                            <div class="search-box mt-2">
                                <button type="submit" class="btn primary-btn">
                                    <?php echo e(__("Submit")); ?></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
                </div>
            </div>
            <div class="row">
                <?php if(count($users) == 0): ?>
                    <div class="bg-light text-center py-5 d-block w-100">
                        <h3>NO RESTAURANT FOUND</h3>
                    </div>
                <?php else: ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="swiper-slide user-card mb-30">
                                <div class="card" data-aos="fade-up" data-aos-delay="100">
                                    <div class="icon">
                                        <?php if($user->image): ?>
                                            <img class="lazy" src="<?php echo e(asset(\App\Constants\Constant::WEBSITE_TENANT_USER_IMAGE .'/'.$user->image)); ?>"
                                                 alt="user">
                                        <?php else: ?>
                                            <img class="lazy" src="<?php echo e(asset('assets/admin/img/propics/blank_user.jpg')); ?>"
                                                 alt="user">
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-content green">
                                        <h3 class="card-title"><?php echo e($user->restaurant_name); ?></h3>
                                        <div class="social-link">
                                            <?php $__currentLoopData = $user->social_media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e($social->url); ?>" target="_blank"><i class="<?php echo e($social->icon); ?>"></i></a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="cta-btns">
                                            <a href="<?php echo e(detailsUrl($user)); ?>" class="btn btn-sm secondary-btn"><?php echo e(__('View Website')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="pagination mb-30 justify-content-center">
                <?php echo e($users->appends(['search' => request()->input('search'),'location' => request()->input('location')])->links()); ?>

            </div>
        </div>
       
      
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/installable/resources/views/front/users.blade.php ENDPATH**/ ?>