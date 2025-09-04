
<footer class="footer-area">
    <?php if($bs->top_footer_section == 1): ?>
        <div class="footer-top pt-120 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12">
                        <div class="footer-widget" >
                            <div class="navbar-brand">
                                <?php if($bs->footer_logo): ?>
                                    <a href="<?php echo e(route('front.index')); ?>">
                                        <img src="<?php echo e(asset('assets/front/img/' . $bs->footer_logo)); ?>" alt="Logo">
                                    </a>
                                <?php endif; ?>

                            </div>
                            <p><?php echo e($bs->footer_text); ?></p>
                            <div class="social-link">


                            </div>
                        </div>
                    </div>
                 
                    <div class="col-lg-2 col-md-2 col-sm-6">
                        <div class="footer-widget" >
                            <?php
                                $ulinks = App\Models\Ulink::where('language_id', $currentLang->id)
                                    ->orderby('id', 'desc')
                                    ->get();
                            ?>
                            <h3><?php echo e($bs->useful_links_title); ?></h3>
                            <ul class="footer-links">
                                <?php $__currentLoopData = $ulinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ulink): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e($ulink->url); ?>"><?php echo e($ulink->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="footer-widget" >
                            <h3> <?php echo e($bs->contact_info_title); ?></h3>

                            <ul class="info-list">
                                <li>
                                    <i class="fal fa-map-marker-alt"></i>
                                    <span><?php echo e($be->contact_addresses); ?></span>
                                </li>
                                <li>
                                    <i class="fal fa-phone"></i>
                                    <a href="tel:00123456789"><?php echo e($be->contact_numbers); ?></a>
                                </li>
                                <li>
                                    <i class="fal fa-envelope"></i>
                                    <a href="mailto:info@example.com"><?php echo e($be->contact_mails); ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="footer-widget" >
                            <h3><?php echo e($bs->newsletter_title); ?></h3>
                            <p><?php echo e($bs->newsletter_subtitle); ?></p>
                            <form id="footerSubscriber" action="<?php echo e(route('front.subscribe')); ?>" method="POST"
                                class="subscribeForm">
                                <?php echo csrf_field(); ?>
                                <div class="input-group">
                                    <input class="form-control" placeholder="<?php echo e(__('Enter Your Email')); ?>"
                                        type="text" name="email" autocomplete="off">
                                    <button class="btn btn-sm primary-btn"
                                        type="submit"><?php echo e(__('Subscribe')); ?></button>
                                </div>
                                <p class="err-email text-danger"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($bs->copyright_section == 1): ?>
        <div class="copy-right-area">
            <div class="container">
                <div class="copy-right-content">
                    <?php if($bs->copyright_section == 1): ?>
                        <span>
                            <?php echo replaceBaseUrl($bs->copyright_text); ?>

                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</footer>

<?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/front/partials/footer.blade.php ENDPATH**/ ?>