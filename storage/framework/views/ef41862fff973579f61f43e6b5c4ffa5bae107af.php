<?php $__env->startSection('styles'); ?>
    <style>
        .hover {
            text-decoration: none !important;
        }

        .text-hover:hover {
            text-decoration: underline !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mt-2 mb-4">
        <h2 class="pb-2"><?php echo e(__('Welcome back')); ?>

            , <?php echo e(Auth::guard('admin')->user()->first_name); ?> <?php echo e(Auth::guard('admin')->user()->last_name); ?>!</h2>
    </div>
    <div class="row">

        <div class="col-sm-6 col-md-4">
            <a class="card card-stats card-info card-round hover" href="javascript:void(0)">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col-7 col-stats">
                            <div class="numbers">
                                <p class="card-category text-hover"><?php echo e(__('Registered Users')); ?></p>
                                <h4 class="card-title">15</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>



            <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-warning card-round hover" href="javascript:void(0)">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-bacteria"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category text-hover"><?php echo e(__('Subscribers')); ?></p>
                                    <h4 class="card-title">30</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>




            <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-success card-round hover" href="javascript:void(0)">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-list-ul"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category text-hover"><?php echo e(__('Packages')); ?></p>
                                    <h4 class="card-title">22</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>




            <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-danger card-round hover" href="javascript:void(0)">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-money-check-alt"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category text-hover"><?php echo e(__('Payment Logs')); ?></p>
                                    <h4 class="card-title">99</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



            <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-secondary card-round hover" href="javascript:void(0)">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category text-hover"><?php echo e(__('Admins')); ?></p>
                                    <h4 class="card-title">26</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



            <div class="col-sm-6 col-md-4">
                <a class="card card-stats card-primary card-round hover"
                    href="javascript:void(0)">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-users-cog"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category text-hover"><?php echo e(__('Blog')); ?></p>
                                    <h4 class="card-title">13</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

    </div>



    <div class="row">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?php echo e(__('Monthly Income')); ?> (<?php echo e(date('Y')); ?>)</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><?php echo e(__('Monthly Premium Users')); ?> (<?php echo e(date('Y')); ?>)</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="usersChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/admin/js/plugin/chart.min.js')); ?>"></script>
    <script>
        "use strict";
        var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
        var inTotals = [0,0,0,0,0,0,0,0,0,0,0,0];
        var userTotals = [0,0,0,0,0,0,0,2,0,0,0,0];
    </script>
    <script src="<?php echo e(asset('assets/admin/js/dashboard.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>