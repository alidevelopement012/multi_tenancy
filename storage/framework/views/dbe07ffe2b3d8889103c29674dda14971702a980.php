<?php use Illuminate\Support\Carbon; ?>


<?php $__env->startSection('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/checkout.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagename'); ?>
  - <?php echo e(__('Checkout')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta-description', !empty($seo) ? $seo->checkout_meta_description : ''); ?>
<?php $__env->startSection('meta-keywords', !empty($seo) ? $seo->checkout_meta_keywords : ''); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
  <?php echo e(__('Checkout')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb-link'); ?>
  <?php echo e(__('Checkout')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

  <section class="checkout-area ptb-90">
    <div class="container">
      <form
        onsubmit="document.getElementById('confirmBtn').innerHTML='Processing...';document.getElementById('confirmBtn').disabled=true;"
        action="<?php echo e(route('front.membership.checkout')); ?>" method="POST" enctype="multipart/form-data" id="my-checkout-form">
        <div class="row">
          <div class="col-lg-8 ">
            <div class="billing_form form-block">
              <div class="title mb-30">
                <h3><?php echo e(__('Billing Details')); ?></h3>
              </div>
              <?php echo csrf_field(); ?>
              <div class="row">
                <input type="hidden" name="username" value="<?php echo e($username); ?>">
                <input type="hidden" name="password" value="<?php echo e($password); ?>">
                <input type="hidden" name="package_type" value="<?php echo e($status); ?>">
                <input type="hidden" name="email" value="<?php echo e($email); ?>">
                <input type="hidden" name="package_id" value="<?php echo e($id); ?>">
                <input type="hidden" name="trial_days" id="trial_days" value="<?php echo e($package->trial_days); ?>">
                <input type="hidden" name="start_date" value="<?php echo e(Carbon::today()->format('d-m-Y')); ?>">
                <?php if($status === 'trial'): ?>
                  <input type="hidden" name="expire_date"
                    value="<?php echo e(Carbon::today()->addDay($package->trial_days)->format('d-m-Y')); ?>">
                <?php else: ?>
                  <?php if($package->term === 'month'): ?>
                    <input type="hidden" name="expire_date" value="<?php echo e(Carbon::today()->addMonth()->format('d-m-Y')); ?>">
                  <?php elseif($package->term === 'lifetime'): ?>
                    <input type="hidden" name="expire_date" value="<?php echo e(Carbon::maxValue()->format('d-m-Y')); ?>">
                  <?php else: ?>
                    <input type="hidden" name="expire_date" value="<?php echo e(Carbon::today()->addYear()->format('d-m-Y')); ?>">
                  <?php endif; ?>
                <?php endif; ?>
                <div class="col-lg-6">
                  <div class="form-group mb-30">
                    <label for="first_name"><?php echo e(__('First Name')); ?>*</label>
                    <input id="first_name" type="text" class="form-control" name="first_name"
                      placeholder="<?php echo e(__('First Name')); ?>" value="<?php echo e(old('first_name')); ?>" required>
                    <?php if($errors->has('first_name')): ?>
                      <span class="error">
                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group mb-30">
                    <label for="last_name"><?php echo e(__('Last Name')); ?>*</label>
                    <input id="last_name" type="text" class="form-control" name="last_name"
                      placeholder="<?php echo e(__('Last Name')); ?>" value="<?php echo e(old('last_name')); ?>" required>
                    <?php if($errors->has('last_name')): ?>
                      <span class="error">
                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group mb-30">
                    <label for="phone"><?php echo e(__('Phone Number')); ?>*</label>
                    <input id="phone" type="text" class="form-control" name="phone"
                      placeholder="<?php echo e(__('Phone Number')); ?>" value="<?php echo e(old('phone')); ?>" required>
                    <?php if($errors->has('phone')): ?>
                      <span class="error">
                        <strong><?php echo e($errors->first('phone')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group mb-30">
                    <label for="email"><?php echo e(__('Email Address')); ?>*</label>
                    <input id="email" type="email" class="form-control" name="email" value="<?php echo e($email); ?>"
                      disabled>
                    <?php if($errors->has('email')): ?>
                      <span class="error">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group mb-30">
                    <label for="address"><?php echo e(__('Street Address')); ?></label>
                    <input id="address" type="text" class="form-control" name="address"
                      placeholder="<?php echo e(__('Street Address')); ?>" value="<?php echo e(old('address')); ?>">
                    <?php if($errors->has('address')): ?>
                      <span class="error">
                        <strong><?php echo e($errors->first('address')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group mb-30">
                    <label for="city"><?php echo e(__('City')); ?></label>
                    <input id="city" type="text" class="form-control" name="city"
                      placeholder="<?php echo e(__('City')); ?>" value="<?php echo e(old('city')); ?>">
                    <?php if($errors->has('city')): ?>
                      <span class="error">
                        <strong><?php echo e($errors->first('city')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group mb-30">
                    <label for="district"><?php echo e(__('State')); ?></label>
                    <input id="district" type="text" class="form-control" name="district"
                      placeholder="<?php echo e(__('State')); ?>" value="<?php echo e(old('district')); ?>">
                    <?php if($errors->has('district')): ?>
                      <span class="error">
                        <strong><?php echo e($errors->first('district')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group mb-30">
                    <label for="country"><?php echo e(__('Country')); ?>*</label>
                    <input id="country" type="text" class="form-control" name="country"
                      placeholder="<?php echo e(__('Country')); ?>" value="<?php echo e(old('country')); ?>" required>
                    <?php if($errors->has('country')): ?>
                      <span class="error">
                        <strong><?php echo e($errors->first('country')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="order_wrap_box mb-40">
              <div id="couponReload">
                <input type="hidden" name="price"
                  value="<?php echo e($status == 'trial' ? 0 : $package->price - $cAmount); ?>">
                <div class="order-summery form-block mb-30 mt-30">

                  <div class="title">
                    <h3><?php echo e(__('Package Summary')); ?></h3>
                  </div>
                  <div class="order-list-info">
                    <ul class="summery-list">
                      <li><?php echo e(__('Package')); ?> <span><?php echo e(__("$package->title")); ?>

                          (<?php echo e(__(ucfirst($package->term))); ?>) </span></li>
                      <li><?php echo e(__('Start Date')); ?>

                        <span><?php echo e(\Carbon\Carbon::today()->format('d-m-Y')); ?></span>
                      </li>
                      <?php if($status === 'trial'): ?>
                        <li>
                          <?php echo e(__('Expiry Date')); ?>

                          <span>
                            <?php echo e(\Carbon\Carbon::today()->addDay($package->trial_days)->format('d-m-Y')); ?>

                          </span>
                        </li>
                      <?php else: ?>
                        <li>
                          <?php echo e(__('Expiry Date')); ?>

                          <span>
                            <?php if($package->term === 'month'): ?>
                              <?php echo e(\Carbon\Carbon::today()->addMonth()->format('d-m-Y')); ?>

                            <?php elseif($package->term === 'lifetime'): ?>
                              <?php echo e(__('Lifetime')); ?>

                            <?php else: ?>
                              <?php echo e(\Carbon\Carbon::today()->addYear()->format('d-m-Y')); ?>

                            <?php endif; ?>
                          </span>
                        </li>
                      <?php endif; ?>
                      <?php if(session()->has('coupon')): ?>
                        <li>
                          <span><?php echo e(__('Package Price')); ?></span>
                          <span class="price">
                            <?php if($status === 'trial'): ?>
                              <?php echo e(__('Free')); ?> (<?php echo e($package->trial_days . ' days'); ?>)
                            <?php elseif($package->price == 0): ?>
                              <?php echo e(__('Free')); ?>

                            <?php else: ?>
                              <?php echo e(format_price($package->price)); ?>

                            <?php endif; ?>
                          </span>
                        </li>
                        <li>
                          <span><?php echo e(__('Discount')); ?></span>
                          <span class="price text-success">
                            - <?php echo e(format_price($cAmount)); ?>

                          </span>
                        </li>
                      <?php endif; ?>
                      <li class="border-0">
                        <span><?php echo e(__('Total')); ?></span>
                        <span class="price">
                          <?php if($status === 'trial'): ?>
                            <?php echo e(__('Free')); ?> (<?php echo e($package->trial_days); ?>

                            <?php echo e(__('days')); ?>)
                          <?php elseif($package->price == 0): ?>
                            <?php echo e(__('Free')); ?>

                          <?php else: ?>
                            <?php echo e(format_price($package->price - $cAmount)); ?>

                          <?php endif; ?>
                        </span>
                      </li>
                    </ul>
                  </div>
                </div>

                <?php if($package->price > 0 && $status != 'trial'): ?>
                  <?php if(!session()->has('coupon')): ?>
                    <div class="row">
                      <div class="col-12">
                        <div class="input-group mb-3 align-items-lg-stretch">
                          <input type="text" class="form-control" name="coupon"
                            placeholder="<?php echo e(__('Enter Coupon Code Here')); ?>">
                          <div class="input-group-append">
                            <span class="btn primary-btn no-animation rounded-1 h-100 coupon-apply"
                              id="basic-addon2"><?php echo e(__('Apply')); ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php else: ?>
                    <div class="alert alert-success">
                      <?php echo e(__('Coupon already applied')); ?>

                    </div>
                  <?php endif; ?>
                <?php endif; ?>

                <?php if($package->price - $cAmount <= 0 || $status == 'trial'): ?>
                <?php else: ?>
                  <div class="order-payment form-block">
                    <div class="title">
                      <h3><?php echo e(__('Payment Method')); ?></h3>
                    </div>
                    <div class="form-group mb-30">
                      <select name="payment_method" id="payment-gateway" class="olima_select">
                        <option value="" selected disabled><?php echo e(__('Choose an option')); ?>

                        </option>
                        <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($payment_method->name); ?>"
                            <?php echo e(old('payment_method') == $payment_method->name ? 'selected' : ''); ?>>
                            <?php echo e($payment_method->name); ?>

                          </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <?php if($errors->has('payment_method')): ?>
                        <span class="method-error">
                          <strong><?php echo e($errors->first('payment_method')); ?></strong>
                        </span>
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>

              <div class="iyzico-element <?php echo e(old('payment_method') == 'Iyzico' ? '' : 'd-none'); ?>">
                <input type="text" name="identity_number" class="form-control mt-2 mb-2"
                  placeholder="<?php echo e(__('Identity Number')); ?>" value="<?php echo e(old('identity_number')); ?>">
                <?php $__errorArgs = ['identity_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <p class="text-danger text-left"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <input type="text" name="zip_code" class="form-control" placeholder="<?php echo e(__('Zip Code')); ?>"
                  value="<?php echo e(old('zip_code')); ?>">
                <?php $__errorArgs = ['zip_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                  <p class="text-danger text-left"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>

              <div class="row d-none py-3" id="tab-stripe">
                <div class="col-lg-12">
                  <div class="form-group mb-3">
                    <div id="stripe-element" class="mb-2 ">

                    </div>
                  </div>
                  <p class="text-danger" id="stripe-errors"></p>
                </div>
              </div>

              <div class="row d-none py-3" id="tab-anet">
                <div class="col-lg-6">
                  <div class="form-group mb-3">
                    <input class="form-control" type="text" id="anetCardNumber" placeholder="Card Number"
                      disabled />
                  </div>
                </div>
                <div class="col-lg-6 mb-3">
                  <div class="form-group">
                    <input class="form-control" type="text" id="anetExpMonth" placeholder="Expire Month"
                      disabled />
                  </div>
                </div>
                <div class="col-lg-6 ">
                  <div class="form-group">
                    <input class="form-control" type="text" id="anetExpYear" placeholder="Expire Year" disabled />
                  </div>
                </div>
                <div class="col-lg-6 ">
                  <div class="form-group">
                    <input class="form-control" type="text" id="anetCardCode" placeholder="Card Code" disabled />
                  </div>
                </div>
                <input type="hidden" name="opaqueDataValue" id="opaqueDataValue" disabled />
                <input type="hidden" name="opaqueDataDescriptor" id="opaqueDataDescriptor" disabled />
                <ul id="anetErrors"></ul>
              </div>

              <div>
                <div id="instructions"></div>
                <input type="hidden" name="is_receipt" value="0" id="is_receipt">
                <?php if($errors->has('receipt')): ?>
                  <span class="error">
                    <strong><?php echo e($errors->first('receipt')); ?></strong>
                  </span>
                <?php endif; ?>
              </div>


              <div class="text-center mt-4">
                <button form="my-checkout-form" id="confirmBtn" class="btn primary-btn w-100"
                  type="submit"><?php echo e(__('Confirm')); ?>

                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script>
    var couponRoute = "<?php echo e(route('front.membership.coupon')); ?>";
    var stripe_key = "<?php echo e($stripe_key ?? ''); ?>";
    var packageId = <?php echo e($package->id); ?>;
    var ogateways = <?php echo json_encode($offline) ?>;
    var oinstructions = "<?php echo e(route('front.payment.instructions')); ?>";
  </script>
  <script src="<?php echo e(asset('assets/front/js/checkout.js')); ?>"></script>


  <?php
    $anet = App\Models\PaymentGateway::find(20);
    $anerInfo = $anet->convertAutoData();
    $anetTest = $anerInfo['sandbox_check'] ?? false;

    if ($anetTest == 1) {
        $anetSrc = 'https://jstest.authorize.net/v1/Accept.js';
    } else {
        $anetSrc = 'https://js.authorize.net/v1/Accept.js';
    }
  ?>
  <script>
    var clientKey = "<?php echo e($anerInfo['public_key'] ?? ''); ?>";
    var loginId = "<?php echo e($anerInfo['login_id'] ?? ''); ?>";
  </script>
  <?php if(!empty($stripe_key)): ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="<?php echo e(asset('assets/front/js/stripe.js')); ?>"></script>
  <?php endif; ?>
  <script type="text/javascript" src="<?php echo e($anetSrc); ?>" charset="utf-8"></script>
  <script src="<?php echo e(asset('assets/front/js/anet.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/front/checkout.blade.php ENDPATH**/ ?>