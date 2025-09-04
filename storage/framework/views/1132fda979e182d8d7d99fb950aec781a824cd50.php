<!DOCTYPE html>
<html lang="en" <?php if($rtl == 1): ?> dir="rtl" <?php endif; ?>>

<head>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $__env->yieldContent('meta-description'); ?>">
  <meta name="keywords" content="<?php echo $__env->yieldContent('meta-keywords'); ?>">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <?php echo $__env->yieldContent('og-meta'); ?>

  <title><?php echo e($bs->website_title); ?> <?php echo $__env->yieldContent('pagename'); ?></title>
  <link rel="shortcut icon" href="<?php echo e(asset('assets/front/img/' . $bs->favicon)); ?>" type="image/png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Rubik:wght@400;500;600&display=swap">

  <link rel="stylesheet" href="<?php echo e(asset('assets/restaurant/css/bootstrap.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/restaurant/fonts/fontawesome/css/all.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/restaurant/css/font-gigo.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/restaurant/css/toastr.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/restaurant/css/magnific-popup.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/restaurant/css/swiper-bundle.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/restaurant/css/aos.min.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/restaurant/css/nice-select.css')); ?>">

  <link rel="stylesheet" href="<?php echo e(asset('assets/restaurant/css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/tinymce-content.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/whatsapp.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/restaurant/css/responsive.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/cookie-alert.css')); ?>">
  <?php if($rtl == 1): ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/restaurant/css/rtl.css')); ?>">
  <?php endif; ?>

  <?php echo $__env->yieldContent('styles'); ?>

  <?php if($bs->is_whatsapp == 0 && $bs->is_tawkto == 0): ?>
    <style>
      .go-top {
        left: auto;
        right: 30px;
      }
    </style>
  <?php endif; ?>

  <style>
    :root {
      --color-primary: #<?php echo e($bs->base_color); ?>;
      --color-primary-shade: #<?php echo e($bs->base_color2); ?>;
      --bg-light: #<?php echo e($bs->base_color2); ?>14;
    }
  </style>
</head>

<body>


  <?php if($bs->preloader_status == 1): ?>
    <div id="preLoader">
      <div class="loader">
        <img src="<?php echo e($bs->preloader ? asset('assets/front/img/' . $bs->preloader) : ''); ?>" alt="">
      </div>
    </div>
  <?php endif; ?>

  <?php if ($__env->exists('front.partials.header')) echo $__env->make('front.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php if(!request()->routeIs('front.index')): ?>
    <div class="page-title-area bg-img"
      style="background-image: url('<?php echo e($bs->breadcrumb ? asset('assets/front/img/' . $bs->breadcrumb) : ''); ?>');">
      <div class="container">
        <div class="content text-center" data-aos="fade-up">
          <h2><?php echo $__env->yieldContent('breadcrumb-title'); ?></h2>
          <ul class="list-unstyled">
            <li class="d-inline"><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="d-inline">/</li>
            <li class="d-inline active"><?php echo $__env->yieldContent('breadcrumb-link'); ?></li>
          </ul>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php echo $__env->yieldContent('content'); ?>


  <?php if ($__env->exists('front.partials.footer')) echo $__env->make('front.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <a href="#" class="go-top"><i class="fal fa-angle-double-up"></i></a>


  <?php if ($__env->exists('front.partials.popups')) echo $__env->make('front.partials.popups', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="cursor"></div>

  <div id="WAButton"></div>

  <script>
    var demo_mode = "<?php echo e(env('DEMO_MODE')); ?>";
  </script>

  <script src="<?php echo e(asset('assets/front/js/jquery.min.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/popper.min.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/bootstrap.min.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/jquery.nice-select.min.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/jquery.magnific-popup.min.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/swiper-bundle.min.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/lazysizes.min.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/aos.min.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/toastr.min.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/whatsapp.min.js')); ?>"></script>

  <script src="<?php echo e(asset('assets/front/js/script.js')); ?>"></script>

  <script>
    var showmore = "<?php echo e(__('Show More')); ?>"
    var showless = "<?php echo e(__('Show Less')); ?>"
  </script>


  <?php if($rtl == 1): ?>
    <script>
      var showmore = "<?php echo e(__('Show More')); ?>"
      var showless = "<?php echo e(__('Show Less')); ?>"
    </script>
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/js/rtl-script.js')); ?>">
  <?php endif; ?>

  <script>
    "use strict";
    var rtl = <?php echo e($rtl); ?>;
  </script>

  <?php echo $__env->yieldContent('scripts'); ?>

  <?php echo $__env->yieldContent('vuescripts'); ?>


  <?php if(session()->has('success')): ?>
    <script>
      "use strict";
      toastr['success']("<?php echo e(__(session('success'))); ?>");
    </script>
  <?php endif; ?>

  <?php if(session()->has('error')): ?>
    <script>
      "use strict";
      toastr['error']("<?php echo e(__(session('error'))); ?>");
    </script>
  <?php endif; ?>

  <?php if(session()->has('warning')): ?>
    <script>
      "use strict";
      toastr['warning']("<?php echo e(__(session('warning'))); ?>");
    </script>
  <?php endif; ?>
  <script>
    "use strict";

    function handleSelect(elm) {
      window.location.href = "<?php echo e(route('changeLanguage', '')); ?>" + "/" + elm.value;
    }
  </script>


  
  <?php if($bs->is_whatsapp == 1): ?>
    <script type="text/javascript">
      "use strict";
      var whatsapp_popup = <?php echo e($bs->whatsapp_popup); ?>;
      var whatsappImg = "<?php echo e(asset('assets/front/img/whatsapp.svg')); ?>";
      $(function() {
        $('#WAButton').floatingWhatsApp({
          phone: "<?php echo e($bs->whatsapp_number); ?>", //WhatsApp Business phone number
          headerTitle: "<?php echo e($bs->whatsapp_header_title); ?>", //Popup Title
          popupMessage: `<?php echo !empty($bs->whatsapp_popup_message) ? nl2br($bs->whatsapp_popup_message) : ''; ?>`, //Popup Message
          showPopup: whatsapp_popup == 1 ? true : false, //Enables popup display
          buttonImage: '<img src="' + whatsappImg + '" />', //Button Image
          position: "right" //Position: left | right

        });
      });
    </script>
  <?php endif; ?>


  <?php if($bs->is_tawkto == 1): ?>
    <?php
      $directLink = str_replace('tawk.to', 'embed.tawk.to', $bs->tawkto_chat_link);
      $directLink = str_replace('chat/', '', $directLink);
    ?>
    <script type="text/javascript">
      "use strict";
      var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
      (function() {
        var s1 = document.createElement("script"),
          s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = '<?php echo e($directLink); ?>';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
      })();
    </script>
  <?php endif; ?>

  <?php if($be->cookie_alert_status == 1): ?>
    <div class="cookie">
      <?php echo $__env->make('cookie-consent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  <?php endif; ?>
</body>

</html>
<?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/installable/resources/views/front/layout.blade.php ENDPATH**/ ?>