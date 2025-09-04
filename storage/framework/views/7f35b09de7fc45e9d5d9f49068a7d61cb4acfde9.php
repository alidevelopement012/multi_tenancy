<?php
    use App\Constants\Constant;
    use App\Http\Helpers\Uploader;
?>

<?php $__env->startSection('pageHeading'); ?>
    <?php echo e($keywords['404'] ?? __('404')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    
    <section class="page-title-area d-flex align-items-center"
             style="background-image:url('<?php echo e(asset('assets/restaurant/images/breadcrum.jpg')); ?>')">
          
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title-item text-center">
                        <h2 class="title"><?php echo e($keywords['404'] ?? __('404')); ?></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo e(route('front.user.detail.view', getParam())); ?>">
                                        <i class="flaticon-home"></i>
                                       
                                        <?php echo e($keywords['Home'] ?? __('Home')); ?>

                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($keywords['404'] ?? __('404')); ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="error-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="not-found">
                        <img src="<?php echo e(asset('assets/front/img/404.png')); ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="error-div">
                        <div class="error-txt">
                        <div class="oops">
                            <img src="<?php echo e(asset('assets/front/img/oops.png')); ?>" alt="">
                        </div>
                        <h2><?php echo e($keywords["Page Not Found"] ?? __('Page Not Found')); ?></h2>
                        <a href="<?php echo e(route('front.user.detail.view', getParam())); ?>"
                           class="go-home-btn">
                            <?php echo e($keywords["Get Back to Home"] ?? __('Get Back to Home')); ?>

                        </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
<?php $__env->stopSection(); ?>


<?php echo $__env->make('user-front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/errors/user-404.blade.php ENDPATH**/ ?>