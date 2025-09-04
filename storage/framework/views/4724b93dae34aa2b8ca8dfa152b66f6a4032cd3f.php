

<header class="header-area <?php echo e(!request()->routeIs('front.index') ? 'header-2': ''); ?>">
  
    <div class="mobile-menu">
        <div class="container">
            <div class="mobile-menu-wrapper"></div>
        </div>
    </div>


    <div class="main-responsive-nav">
        <div class="container">
       
            <div class="logo">
                <a href="<?php echo e(route('front.index')); ?>">
                    <img src="<?php echo e(asset('assets/front/img/'.$bs->logo)); ?>" alt="logo">
                </a>
            </div>
           
            <button class="menu-toggler" type="button">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
    <div class="main-navbar">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
             
                <a class="navbar-brand" href="<?php echo e(route('front.index')); ?>">
                    <img src="<?php echo e(asset('assets/front/img/'.$bs->logo)); ?>" alt="Logo">
                </a>
         
                <div class="collapse navbar-collapse">
                    <ul id="mainMenu" class="navbar-nav mobile-item">
                        <?php
                            $links = json_decode($menus, true);
                        ?>
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $href = getHref($link);
                            ?>

                            <?php if(!array_key_exists("children",$link)): ?>
                                <li class="nav-item">
                                    <a class="nav-link " target="<?php echo e($link["target"]); ?>" href="<?php echo e($href); ?>"><?php echo e($link["text"]); ?></a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link " target="<?php echo e($link["target"]); ?>" href="<?php echo e($href); ?>"><?php echo e($link["text"]); ?></a>
                                    <ul class="menu-dropdown">
                                        <?php $__currentLoopData = $link["children"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $l2Href = getHref($level2);
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo e($l2Href); ?>" target="<?php echo e($level2["target"]); ?>"><?php echo e($level2["text"]); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="more-option mobile-item">
                    <?php if(auth()->guard()->guest()): ?>
                        <div class="item">
                            <a href="<?php echo e(route('user.login')); ?>" class="btn primary-btn">
                                <span><?php echo e(__('Login')); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                        <div class="item">
                            <a href="<?php echo e(route('user.dashboard')); ?>" class="btn primary-btn">
                                <span><?php echo e(__('Dashboard')); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="item">
                        <div class="language">
                            <?php if(!empty($currentLang)): ?>
                                <select onchange="handleSelect(this)">
                                    <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lang->code); ?>"
                                            <?php echo e($currentLang->code === $lang->code ? "selected" : ""); ?>

                                        >
                                            <?php echo e($lang->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>

<?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/front/partials/header.blade.php ENDPATH**/ ?>