<?php
    use App\Models\Package;
?>


<?php $__env->startSection('pagename'); ?>
    - <?php echo e(__('Pricing')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta-description', !empty($seo) ? $seo->pricing_meta_description : ''); ?>
<?php $__env->startSection('meta-keywords', !empty($seo) ? $seo->pricing_meta_keywords : ''); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
    <?php echo e(__('Pricing')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-link'); ?>
    <?php echo e(__('Pricing')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="pricing-area pt-120 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="nav-tabs-navigation text-center" data-aos="fade-up">
                        <ul class="nav nav-tabs">
                            <?php if(count($terms) > 1): ?>
                                <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <button class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>" data-bs-toggle="tab"
                                            data-bs-target="#<?php echo e(__("$term")); ?>" type="button">
                                            <?php if($term == 'Month'): ?>
                                                <?php echo e(__("$term" . 'ly')); ?>

                                            <?php endif; ?>
                                            <?php if($term == 'Year'): ?>
                                                <?php echo e(__("$term" . 'ly')); ?>

                                            <?php endif; ?>
                                            <?php if($term == 'Lifetime'): ?>
                                                <?php echo e(__("$term")); ?>

                                            <?php endif; ?>
                                        </button>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                     <div class="tab-content">
                            <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>"
                                    id="<?php echo e(__("$term")); ?>">
                                    <?php
                                        $packages = Package::query()
                                            ->where('status', '1')
                                            ->where('featured', '1')
                                            ->where('term', strtolower($term))
                                            ->get();
                                    ?>
                                    <div class="row justify-content-center">
                                        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $pFeatures = json_decode($package->features);
                                            ?>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="card mb-30 <?php echo e($package->recommended == '1' ? 'active' : ''); ?>"
                                                    data-aos="fade-up" data-aos-delay="100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon"><i class="<?php echo e($package->icon); ?>"></i></div>
                                                        <div class="label">
                                                            <h3><?php echo e(__($package->title)); ?></h3>
                                                            <?php if($package->recommended): ?>
                                                                <span><?php echo e(__('Recommended')); ?></span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <p class="text"></p>
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="price"><?php echo e($package->price != 0 && $be->base_currency_symbol_position == 'left' ? $be->base_currency_symbol : ''); ?><?php echo e($package->price == 0 ? 'Free' : $package->price); ?><?php echo e($package->price != 0 && $be->base_currency_symbol_position == 'right' ? $be->base_currency_symbol : ''); ?></span>
                                                        <?php
                                                            $termname = ucfirst($package->term);
                                                        ?>
                                                        <span class="period">/ <?php echo e(__("$termname")); ?> </span>
                                                    </div>
                                                    <h5><?php echo e(__('Whats Included')); ?></h5>
                                                   
                                                    <ul class="pricing-list list-unstyled p-0">
                                                        <li>
                                                            <i class="fal fa-check"></i>
                                                            <?php echo e(__('Categories')); ?>

                                                            <?php echo e($package->categories_limit == 999999 ? '(' . __('Unlimited') . ')' : ' (' . $package->categories_limit . ')'); ?>

                                                        </li>
                                                        <li>
                                                            <i class="fal fa-check"></i>
                                                            <?php echo e(__('Subcategories')); ?>

                                                            <?php echo e($package->subcategories_limit == 999999 ? '(' . __('Unlimited') . ')' : ' (' . $package->subcategories_limit . ')'); ?>

                                                        </li>
                                                        <li>
                                                            <i class="fal fa-check"></i>
                                                            <?php echo e(__('Items')); ?>

                                                            <?php echo e($package->items_limit == 999999 ? '(' . __('Unlimited') . ')' : ' (' . $package->items_limit . ')'); ?>

                                                        </li>
                                                        <li>
                                                            <i class="fal fa-check"></i>
                                                            <?php echo e(__('Languages')); ?>

                                                            <?php echo e($package->language_limit == 999999 ? '(' . __('Unlimited') . ')' : ' (' . $package->language_limit . ')'); ?>

                                                        </li>
                                                        <?php if(is_array($pFeatures) && in_array('Storage Limit', $pFeatures)): ?>
                                                            <li>
                                                                <i class=" fal fa-check"></i>
                                                                <?php echo e(__('Storage Limit')); ?>

                                                                <?php if($package->storage_limit == 999999): ?>
                                                                    <?php echo e('(' . __('Unlimited') . ')'); ?>

                                                                <?php elseif($package->storage_limit == 0 || $package->storage_limit == 999999): ?>
                                                                    <?php echo e(__("$feature")); ?>

                                                                <?php elseif($package->storage_limit < 1024): ?>
                                                                    <?php echo e('(' . $package->storage_limit . 'MB )'); ?>

                                                                <?php else: ?>
                                                                    <?php echo e('(' . ceil($package->storage_limit / 1024) . 'GB)'); ?>

                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endif; ?>

                                                        <?php if(is_array($pFeatures) && in_array('Amazon AWS s3', $pFeatures)): ?>
                                                            <li>
                                                                <i class=" fal fa-check"></i>
                                                                <?php echo e(__('Amazon AWS s3')); ?>

                                                            </li>
                                                        <?php endif; ?>

                                                        <?php $__currentLoopData = $allPfeatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li
                                                                class="<?php echo e(is_array($pFeatures) && in_array($feature, $pFeatures) ? '' : 'disabled'); ?>">
                                                                <i
                                                                    class="<?php echo e(is_array($pFeatures) && in_array($feature, $pFeatures) ? 'fal fa-check' : 'fal fa-times'); ?>"></i>
                                                                <?php if($feature == 'Staffs'): ?>
                                                                    <?php echo e(__("$feature")); ?>

                                                                    <?php if( is_array($pFeatures) && in_array($feature, $pFeatures)): ?>
                                                                    <?php echo e($package->staff_limit == 999999 ? '(' . __('Unlimited') . ')' : ' (' . $package->staff_limit . ')'); ?>

                                                                    <?php endif; ?>
                                                                <?php elseif($feature == 'Table Reservation'): ?>
                                                                    <?php echo e(__("$feature") . 's'); ?>

                                                                    <?php echo e($package->table_reservation_limit == 999999 ? '(' . __('Unlimited') . ')' : ' (' . $package->table_reservation_limit . ')'); ?>

                                                                <?php elseif($feature == 'Online Order'): ?>
                                                                    <?php echo e(__("$feature")); ?>

                                                                <?php elseif($feature == 'Live Orders'): ?>
                                                                    <?php echo e(__('Realtime Order Refresh & Notification')); ?>

                                                                <?php else: ?>
                                                                    <?php echo e(__("$feature")); ?>

                                                                <?php endif; ?>
                                                            </li>
                                                            <?php if($feature == 'Online Order'): ?>
                                                                 <li
                                                                class="<?php echo e(is_array($pFeatures) && in_array($feature, $pFeatures) ? '' : 'disabled'); ?>">
                                                                <i
                                                                    class="<?php echo e(is_array($pFeatures) && in_array($feature, $pFeatures) ? 'fal fa-check' : 'fal fa-times'); ?>">
                                                                </i>
                                                                     <?php echo e(__("Orders")); ?>

                                                                     <?php if( is_array($pFeatures) && in_array($feature, $pFeatures)): ?>
                                                                    <?php echo e($package->order_limit == 999999 ? '(' . __('Unlimited') . ')' : ' (' . $package->order_limit . ')'); ?>

                                                                    <?php endif; ?>
                                                                     
                                                               </li>  
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </ul>
                                                    <div class="d-flex align-items-center">
                                                        <?php if($package->is_trial === '1' && $package->price != 0): ?>
                                                            <a href="<?php echo e(route('front.register.view', ['status' => 'trial', 'id' => $package->id])); ?>"
                                                                class="btn secondary-btn"><?php echo e(__('Trial')); ?></a>
                                                        <?php endif; ?>
                                                        <?php if($package->price == 0): ?>
                                                            <a href="<?php echo e(route('front.register.view', ['status' => 'regular', 'id' => $package->id])); ?>"
                                                                class="btn primary-btn"><?php echo e(__('Signup')); ?></a>
                                                        <?php else: ?>
                                                            <a href="<?php echo e(route('front.register.view', ['status' => 'regular', 'id' => $package->id])); ?>"
                                                                class="btn primary-btn"><?php echo e(__('Purchase')); ?></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                </div>
            </div>
    </section>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/front/pricing.blade.php ENDPATH**/ ?>