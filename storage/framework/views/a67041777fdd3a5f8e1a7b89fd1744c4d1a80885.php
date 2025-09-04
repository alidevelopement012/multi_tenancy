<?php $__env->startSection('template_title'); ?>
    <?php echo e(trans('installer_messages.environment.wizard.templateTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <i class="fa fa-database fa-fw" aria-hidden="true"></i>
    <?php echo trans('installer_messages.environment.wizard.title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>
    <div class="tabs tabs-full">
        <?php if(session()->has('license_success')): ?>
            <div class="alert alert-success" style="background-color: #d4edda;" id="license_alert">
                <p style="margin-bottom: 0px;color: #155724;"><?php echo e(session()->get('license_success')); ?></p>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo e(route('LaravelInstaller::environmentSaveWizard')); ?>" class="tabs-wrap">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">

            <div>
                <div class="form-group <?php echo e($errors->has('app_name') ? ' has-error ' : ''); ?>">
                    <label for="app_name">
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_name_label')); ?>

                    </label>
                    <input type="text" name="app_name" id="app_name" value="" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_name_placeholder')); ?>" />
                    <?php if($errors->has('app_name')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('app_name')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group <?php echo e($errors->has('app_debug') ? ' has-error ' : ''); ?>" style="margin-bottom: 5px;">
                    <label for="app_debug">
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_debug_label')); ?>

                    </label>
                    <label for="app_debug_true">
                        <input type="radio" name="app_debug" id="app_debug_true" value=true />
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_debug_label_true')); ?>

                    </label>
                    <label for="app_debug_false">
                        <input type="radio" name="app_debug" id="app_debug_false" value=false checked />
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_debug_label_false')); ?>

                    </label>
                    <?php if($errors->has('app_debug')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('app_debug')); ?>

                        </span>
                    <?php endif; ?>
                </div>


                <div class="form-group <?php echo e($errors->has('app_url') ? ' has-error ' : ''); ?>">
                    <label for="app_url">
                        <?php echo e(trans('installer_messages.environment.wizard.form.app_url_label')); ?>

                    </label>
                    <input type="url" name="app_url" id="app_url" value="http://localhost" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_url_placeholder')); ?>" />
                    <?php if($errors->has('app_url')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('app_url')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <?php
                    $parsedUrl = parse_url(url()->current());
                    $host =  $parsedUrl['host'];
                ?>
                <div class="form-group <?php echo e($errors->has('website_host') ? ' has-error ' : ''); ?>">
                    <label for="website_host">
                        <?php echo e(trans('installer_messages.environment.wizard.form.website_host_label')); ?>

                    </label>
                    <input type="text" name="website_host" id="website_host" value="<?php echo e($host); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.website_host_placeholder')); ?>" />
                    <p style="color: #ff3737;">** If you give incorrect website host, then 404 error will be shown throughout the whole website</p>
                    <?php if($errors->has('website_host')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('website_host')); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <div class="alert alert-warning">
                    <ul style="margin-bottom: 0px;">
                        <li>if your website URL is <code style="color: #ff3737;">https://example.com/</code> , then host will be <code style="color: #ff3737;">emaple.com</code></li>
                        <li>if your website URL is <code style="color: #ff3737;">https://subdomain.example.com/</code> , then host will be <code style="color: #ff3737;">subdomain.example.com</code></li>
                    </ul>
                </div>


                <div class="form-group <?php echo e($errors->has('database_hostname') ? ' has-error ' : ''); ?>">
                    <label for="database_hostname">
                        <?php echo e(trans('installer_messages.environment.wizard.form.db_host_label')); ?>

                    </label>
                    <input type="text" name="database_hostname" id="database_hostname" value="127.0.0.1" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.db_host_placeholder')); ?>" />
                    <?php if($errors->has('database_hostname')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('database_hostname')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group <?php echo e($errors->has('database_name') ? ' has-error ' : ''); ?>">
                    <label for="database_name">
                        <?php echo e(trans('installer_messages.environment.wizard.form.db_name_label')); ?>

                    </label>
                    <input type="text" name="database_name" id="database_name" value="" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.db_name_placeholder')); ?>" />
                    <?php if($errors->has('database_name')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('database_name')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group <?php echo e($errors->has('database_username') ? ' has-error ' : ''); ?>">
                    <label for="database_username">
                        <?php echo e(trans('installer_messages.environment.wizard.form.db_username_label')); ?>

                    </label>
                    <input type="text" name="database_username" id="database_username" value="" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.db_username_placeholder')); ?>" />
                    <?php if($errors->has('database_username')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('database_username')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group <?php echo e($errors->has('database_password') ? ' has-error ' : ''); ?>">
                    <label for="database_password">
                        <?php echo e(trans('installer_messages.environment.wizard.form.db_password_label')); ?>

                    </label>
                    <input type="password" name="database_password" id="database_password" value="" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.db_password_placeholder')); ?>" />
                    <?php if($errors->has('database_password')): ?>
                        <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo e($errors->first('database_password')); ?>

                        </span>
                    <?php endif; ?>
                </div>

                <div class="buttons">
                    <button class="button" type="submit">
                        <?php echo e(trans('installer_messages.environment.wizard.form.buttons.install')); ?>

                        <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

        </form>

    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/installable/resources/views/vendor/installer/environment-wizard.blade.php ENDPATH**/ ?>