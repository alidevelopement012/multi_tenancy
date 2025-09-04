<div class="sidebar sidebar-style-2" <?php if(request()->cookie('admin-theme') == 'dark'): ?> data-background-color="dark2" <?php endif; ?>>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <?php if(!empty(Auth::guard('admin')->user()->image)): ?>
                        <img src="<?php echo e(asset('assets/admin/img/propics/' . Auth::guard('admin')->user()->image)); ?>"
                            alt="..." class="avatar-img rounded">
                    <?php else: ?>
                        <img src="<?php echo e(asset('assets/admin/img/propics/blank_user.jpg')); ?>" alt="..."
                            class="avatar-img rounded">
                    <?php endif; ?>
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?php echo e(Auth::guard('admin')->user()->first_name); ?>

                            <span class="user-level">Admin</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="<?php echo e(route('admin.edit.profile')); ?>">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.change.password')); ?>">
                                    <span class="link-collapse">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.logout')); ?>">
                                    <span class="link-collapse">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item <?php if(request()->path() == 'admin/dashboard'): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="la flaticon-paint-palette"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php if(empty($admin->role) || (!empty($permissions) && in_array('Role Management', $permissions))): ?>
                    <li
                        class="nav-item
                      <?php if(request()->path() == 'admin/roles'): ?> active
                      <?php elseif(request()->is('admin/role/*/permissions/manage')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.role.index')); ?>">
                            <i class="la flaticon-multimedia-2"></i>
                            <p><?php echo e(__('Role Management')); ?></p>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.tenant.index')); ?>">
                        <i class="la flaticon-users"></i>
                        <p><?php echo e(__('Tenants Management')); ?></p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/admin/partials/side-navbar.blade.php ENDPATH**/ ?>