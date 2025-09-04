<?php $__env->startSection('content'); ?>
  <div class="page-header">
    <h4 class="page-title"><?php echo e(__('Payment Gateways')); ?></h4>
    <ul class="breadcrumbs">
      <li class="nav-home">
        <a href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="flaticon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="flaticon-right-arrow"></i>
      </li>
      <li class="nav-item">
        <a href="#"><?php echo e(__('Payment Gateways')); ?></a>
      </li>
    </ul>
  </div>
  <div class="row">

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.yoco.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Yoco')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Yoco Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($yoco->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($yoco->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $yocoInfo = json_decode($yoco->information, true); ?>


                <div class="form-group">
                  <label><?php echo e(__('Secret Key')); ?></label>
                  <input type="text" class="form-control" name="secret_key" value="<?php echo e(@$yocoInfo['secret_key']); ?>">
                  <?php if($errors->has('secret_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('secret_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="card">
        <form class="" action="<?php echo e(route('admin.paystack.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title">Paystack</div>
              </div>
            </div>
          </div>
          <div class="card-body ">
            <div class="row">
              <div class="col-lg-12">
                <?php echo csrf_field(); ?>
                <?php
                  $paystackInfo = json_decode($paystack->information, true);
                ?>
                <div class="form-group">
                  <label>Paystack</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($paystack->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Active</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($paystack->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Deactive</span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label>Paystack Secret Key</label>
                  <input class="form-control" name="key" value="<?php echo e($paystackInfo['key']); ?>">
                  <?php if($errors->has('key')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('key')); ?></p>
                  <?php endif; ?>
                </div>

              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" id="displayNotif" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form class="" action="<?php echo e(route('admin.mollie.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title">Mollie Payment</div>
              </div>
            </div>
          </div>


          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <?php echo csrf_field(); ?>
                <?php
                  $mollieInfo = json_decode($mollie->information, true);
                ?>
                <div class="form-group">
                  <label>Mollie Payment</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($mollie->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Active</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($mollie->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Deactive</span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label>Mollie Payment Key</label>
                  <input class="form-control" name="key" value="<?php echo e($mollieInfo['key']); ?>">
                  <?php if($errors->has('key')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('key')); ?></p>
                  <?php endif; ?>
                </div>

              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.xendit.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Xendit')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Xendit Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($xendit->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($xendit->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $xenditInfo = json_decode($xendit->information, true); ?>


                <div class="form-group">
                  <label><?php echo e(__('Secret Key')); ?></label>
                  <input type="text" class="form-control" name="secret_key"
                    value="<?php echo e(@$xenditInfo['secret_key']); ?>">
                  <?php if($errors->has('secret_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('secret_key')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.perfect_money.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Perfect Money')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Perfect Money Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($perfect_money->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($perfect_money->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $perfect_moneyInfo = json_decode($perfect_money->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Perfect Money Wallet Id')); ?></label>
                  <input type="text" class="form-control" name="perfect_money_wallet_id"
                    value="<?php echo e(@$perfect_moneyInfo['perfect_money_wallet_id']); ?>">
                  <?php if($errors->has('perfect_money_wallet_id')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('perfect_money_wallet_id')); ?></p>
                  <?php endif; ?>

                  <p class="text-warning mt-1 mb-0"><?php echo e(__('You will get wallet id form here')); ?> </p>
                  <a href="https://prnt.sc/bM3LqLXBduaq" target="_blank">https://prnt.sc/bM3LqLXBduaq</a>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form class="" action="<?php echo e(route('admin.flutterwave.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title">Flutterwave</div>
              </div>
            </div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-12">
                <?php echo csrf_field(); ?>
                <?php
                  $flutterwaveInfo = json_decode($flutterwave->information, true);
                ?>
                <div class="form-group">
                  <label>Flutterwave</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($flutterwave->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Active</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($flutterwave->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Deactive</span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label>Flutterwave Public Key</label>
                  <input class="form-control" name="public_key" value="<?php echo e($flutterwaveInfo['public_key']); ?>">
                  <?php if($errors->has('public_key')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('public_key')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Flutterwave Secret Key</label>
                  <input class="form-control" name="secret_key" value="<?php echo e($flutterwaveInfo['secret_key']); ?>">
                  <?php if($errors->has('secret_key')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('secret_key')); ?></p>
                  <?php endif; ?>
                </div>

              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form class="" action="<?php echo e(route('admin.razorpay.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title">Razorpay</div>
              </div>
            </div>
          </div>


          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-12">
                <?php echo csrf_field(); ?>
                <?php
                  $razorpayInfo = json_decode($razorpay->information, true);
                ?>
                <div class="form-group">
                  <label>Razorpay</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($razorpay->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Active</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($razorpay->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Deactive</span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label>Razorpay Key</label>
                  <input class="form-control" name="key" value="<?php echo e($razorpayInfo['key']); ?>">
                  <?php if($errors->has('key')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label>Razorpay Secret</label>
                  <input class="form-control" name="secret" value="<?php echo e($razorpayInfo['secret']); ?>">
                  <?php if($errors->has('secret')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('secret')); ?></p>
                  <?php endif; ?>
                </div>

              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form class="" action="<?php echo e(route('admin.mercadopago.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title">Mercadopago</div>
              </div>
            </div>
          </div>


          <div class="card-body pt-5 pb-5">

            <?php echo csrf_field(); ?>
            <?php
              $mercadopagoInfo = json_decode($mercadopago->information, true);
            ?>
            <div class="form-group">
              <label>Mercado Pago</label>
              <div class="selectgroup w-100">
                <label class="selectgroup-item">
                  <input type="radio" name="status" value="1" class="selectgroup-input"
                    <?php echo e($mercadopago?->status == 1 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button">Active</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="status" value="0" class="selectgroup-input"
                    <?php echo e($mercadopago?->status == 0 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button">Deactive</span>
                </label>
              </div>
            </div>

            <div class="form-group">
              <label>Mercado Pago Test Mode</label>
              <div class="selectgroup w-100">
                <label class="selectgroup-item">
                  <input type="radio" name="sandbox_check" value="1" class="selectgroup-input"
                    <?php echo e(!is_null($mercadopagoInfo) && $mercadopagoInfo['sandbox_check'] == 1 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button">Active</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="sandbox_check" value="0" class="selectgroup-input"
                    <?php echo e(!is_null($mercadopagoInfo) && $mercadopagoInfo['sandbox_check'] == 0 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button">Deactive</span>
                </label>
              </div>
            </div>

            <div class="form-group">
              <label>Mercadopago Token</label>
              <input class="form-control" name="token"
                value="<?php echo e(!is_null($mercadopagoInfo) ? $mercadopagoInfo['token'] : ''); ?>">
              <?php if($errors->has('token')): ?>
                <p class="mb-0 text-danger"><?php echo e($errors->first('token')); ?></p>
              <?php endif; ?>
            </div>
          </div>

          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form class="" action="<?php echo e(route('admin.stripe.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title">Stripe</div>
              </div>
            </div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-12">
                <?php echo csrf_field(); ?>
                <?php
                  $stripeInfo = json_decode($stripe->information, true);
                ?>
                <div class="form-group">
                  <label>Stripe</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($stripe->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Active</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($stripe->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Deactive</span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label>Stripe Key</label>
                  <input class="form-control" name="key" value="<?php echo e($stripeInfo['key']); ?>">
                  <?php if($errors->has('key')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('key')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Stripe Secret</label>
                  <input class="form-control" name="secret" value="<?php echo e($stripeInfo['secret']); ?>">
                  <?php if($errors->has('secret')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('secret')); ?></p>
                  <?php endif; ?>
                </div>

              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" id="displayNotif" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.myfatoorah.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('MyFatoorah')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('MyFatoorah Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($myfatoorah->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($myfatoorah->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $myfatoorahInfo = json_decode($myfatoorah->information, true); ?>
                <div class="form-group">
                  <label><?php echo e(__('Sandbox Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="1" class="selectgroup-input"
                        <?php echo e(@$myfatoorahInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="0" class="selectgroup-input"
                        <?php echo e(@$myfatoorahInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Token')); ?></label>
                  <input type="text" class="form-control" name="token" value="<?php echo e(@$myfatoorahInfo['token']); ?>">
                  <?php if($errors->has('token')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('token')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.midtrans.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Midtrans')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Midtrans Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($midtrans->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($midtrans->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $midtransInfo = json_decode($midtrans->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Midtrans Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="is_production" value="1" class="selectgroup-input"
                        <?php echo e($midtransInfo['is_production'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="is_production" value="0" class="selectgroup-input"
                        <?php echo e($midtransInfo['is_production'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('is_production')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('is_production')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Server Key')); ?></label>
                  <input type="text" class="form-control" name="server_key"
                    value="<?php echo e($midtransInfo['server_key']); ?>">
                  <?php if($errors->has('server_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('server_key')); ?></p>
                  <?php endif; ?>
                </div>
                <p class="text-warning">Your Success URL : <?php echo e(route('midtrans.bank_notify')); ?> </p>
                <p class="text-warning">Your Cancel URL : <?php echo e(route('midtrans.cancel')); ?></p>
                <p>
                  <strong class="text-warning">Set these URLs in Midtrans Dashboard like this :</strong> <br>
                  <a href="https://prnt.sc/OiucUCeYJIXo" target="_blank">https://prnt.sc/OiucUCeYJIXo</a>
                </p>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.paypal.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Paypal')); ?></div>
              </div>
            </div>
          </div>
          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-12">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                  <label><?php echo e(__('Paypal')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($paypal->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($paypal->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                </div>
                <?php
                  $paypalInfo = json_decode($paypal->information, true);
                ?>
                <div class="form-group">
                  <label><?php echo e(__('Paypal Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_check" value="1" class="selectgroup-input"
                        <?php echo e($paypalInfo['sandbox_check'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_check" value="0" class="selectgroup-input"
                        <?php echo e($paypalInfo['sandbox_check'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Paypal Client ID')); ?></label>
                  <input class="form-control" name="client_id" value="<?php echo e($paypalInfo['client_id']); ?>">
                  <?php if($errors->has('client_id')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('client_id')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Paypal Client Secret')); ?></label>
                  <input class="form-control" name="client_secret" value="<?php echo e($paypalInfo['client_secret']); ?>">
                  <?php if($errors->has('client_secret')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('client_secret')); ?></p>
                  <?php endif; ?>
                </div>

              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" id="displayNotif" class="btn btn-success"><?php echo e(__('Update')); ?></button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.toyyibpay.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Toyyibpay')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Toyyibpay Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($toyyibpay->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($toyyibpay->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $toyyibpayInfo = json_decode($toyyibpay->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Toyyibpay Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="1" class="selectgroup-input"
                        <?php echo e($toyyibpayInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="0" class="selectgroup-input"
                        <?php echo e($toyyibpayInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Secret Key')); ?></label>
                  <input type="text" class="form-control" name="secret_key"
                    value="<?php echo e(@$toyyibpayInfo['secret_key']); ?>">
                  <?php if($errors->has('secret_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('secret_key')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Category Code')); ?></label>
                  <input type="text" class="form-control" name="category_code"
                    value="<?php echo e(@$toyyibpayInfo['category_code']); ?>">
                  <?php if($errors->has('category_code')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('category_code')); ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form class="" action="<?php echo e(route('admin.instamojo.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title">Instamojo</div>
              </div>
            </div>
          </div>


          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-12">
                <?php echo csrf_field(); ?>
                <?php
                  $instamojoInfo = json_decode($instamojo->information, true);
                ?>
                <div class="form-group">
                  <label>Instamojo</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($instamojo->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Active</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($instamojo->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Deactive</span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label>Test Mode</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_check" value="1" class="selectgroup-input"
                        <?php echo e($instamojoInfo['sandbox_check'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Active</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_check" value="0" class="selectgroup-input"
                        <?php echo e($instamojoInfo['sandbox_check'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Deactive</span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label>Instamojo API Key</label>
                  <input class="form-control" name="key" value="<?php echo e($instamojoInfo['key']); ?>">
                  <?php if($errors->has('key')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('key')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Instamojo Auth Token</label>
                  <input class="form-control" name="token" value="<?php echo e($instamojoInfo['token']); ?>">
                  <?php if($errors->has('token')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('token')); ?></p>
                  <?php endif; ?>
                </div>

              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.iyzico.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Iyzico')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Iyzico Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($iyzico->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($iyzico->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $iyzicoInfo = json_decode($iyzico->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Iyzico Test Mode')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="1" class="selectgroup-input"
                        <?php echo e($iyzicoInfo['sandbox_status'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_status" value="0" class="selectgroup-input"
                        <?php echo e($iyzicoInfo['sandbox_status'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('sandbox_status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('sandbox_status')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Api Key')); ?></label>
                  <input type="text" class="form-control" name="api_key" value="<?php echo e($iyzicoInfo['api_key']); ?>">
                  <?php if($errors->has('api_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('api_key')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Secret Key')); ?></label>
                  <input type="text" class="form-control" name="secret_key"
                    value="<?php echo e($iyzicoInfo['secret_key']); ?>">
                  <?php if($errors->has('secret_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('secret_key')); ?></p>
                  <?php endif; ?>
                </div>
                <p class="text-warning"><strong>Cron Job Command :</strong> <br>
                  <code>curl -sS <?php echo e(route('cron.expired')); ?></code>
                </p>
                <strong class="text-warning">Set the cron job following this video: </strong>
                <a href="https://www.awesomescreenshot.com/video/25404126?key=3f7a7fa8cf2391113bb926f43609fa56"
                  target="_blank">https://www.awesomescreenshot.com/video/25404126?key=3f7a7fa8cf2391113bb926f43609fa56</a>
                <p class="text-danger">without cronjob setup, Iyzico payment method won't work</p>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form action="<?php echo e(route('admin.paytabs.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title"><?php echo e(__('Paytabs')); ?></div>
              </div>
            </div>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <label><?php echo e(__('Paytabs Status')); ?></label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($paytabs->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Active')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($paytabs->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Deactive')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('status')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('status')); ?></p>
                  <?php endif; ?>
                </div>

                <?php $paytabsInfo = json_decode($paytabs->information, true); ?>

                <div class="form-group">
                  <label><?php echo e(__('Country')); ?></label>
                  <select name="country" id="" class="form-control">
                    <option value="global" <?php if($paytabsInfo['country'] == 'global'): echo 'selected'; endif; ?>><?php echo e(__('Global')); ?></option>
                    <option value="sa" <?php if($paytabsInfo['country'] == 'sa'): echo 'selected'; endif; ?>><?php echo e(__('Saudi Arabia')); ?></option>
                    <option value="uae" <?php if($paytabsInfo['country'] == 'uae'): echo 'selected'; endif; ?>><?php echo e(__('United Arab Emirates')); ?></option>
                    <option value="egypt" <?php if($paytabsInfo['country'] == 'egypt'): echo 'selected'; endif; ?>><?php echo e(__('Egypt')); ?></option>
                    <option value="oman" <?php if($paytabsInfo['country'] == 'oman'): echo 'selected'; endif; ?>><?php echo e(__('Oman')); ?></option>
                    <option value="jordan" <?php if($paytabsInfo['country'] == 'jordan'): echo 'selected'; endif; ?>><?php echo e(__('Jordan')); ?></option>
                    <option value="iraq" <?php if($paytabsInfo['country'] == 'iraq'): echo 'selected'; endif; ?>><?php echo e(__('Iraq')); ?></option>
                  </select>
                  <?php if($errors->has('country')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('server_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label><?php echo e(__('Server Key')); ?></label>
                  <input type="text" class="form-control" name="server_key"
                    value="<?php echo e(@$paytabsInfo['server_key']); ?>">
                  <?php if($errors->has('server_key')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('server_key')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('Profile Id')); ?></label>
                  <input type="text" class="form-control" name="profile_id"
                    value="<?php echo e(@$paytabsInfo['profile_id']); ?>">
                  <?php if($errors->has('profile_id')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('profile_id')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label><?php echo e(__('API Endpoint')); ?></label>
                  <input type="text" class="form-control" name="api_endpoint"
                    value="<?php echo e(@$paytabsInfo['api_endpoint']); ?>">
                  <?php if($errors->has('api_endpoint')): ?>
                    <p class="mt-1 mb-0 text-danger"><?php echo e($errors->first('api_endpoint')); ?></p>
                  <?php endif; ?>
                  <p class="mt-1 mb-0 text-warning">You will get your 'API Endpoit' from PayTabs Dashboard.
                  </p>
                  <strong class="text-warning">Step 1:</strong> <a href="https://prnt.sc/McaCbxt75fyi"
                    target="_blank">https://prnt.sc/McaCbxt75fyi</a><br>
                  <strong class="text-warning">Step 2:</strong> <a href="https://prnt.sc/DgztAyHVR2o8"
                    target="_blank">https://prnt.sc/DgztAyHVR2o8</a>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">
                  <?php echo e(__('Update')); ?>

                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form class="" action="<?php echo e(route('admin.phonepe.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title">PhonePe</div>
              </div>
            </div>
          </div>


          <div class="card-body pt-5 pb-5">

            <?php echo csrf_field(); ?>
            <?php
              $phonePeInfo = json_decode($phonepe->information, true);
            ?>
            <div class="form-group">
              <label>PhonePe</label>
              <div class="selectgroup w-100">
                <label class="selectgroup-item">
                  <input type="radio" name="status" value="1" class="selectgroup-input"
                    <?php echo e($phonepe->status == 1 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button">Active</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="status" value="0" class="selectgroup-input"
                    <?php echo e($phonepe->status == 0 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button">Deactive</span>
                </label>
              </div>
            </div>

            <div class="form-group">
              <label>PhonePe Test Mode</label>
              <div class="selectgroup w-100">
                <label class="selectgroup-item">
                  <input type="radio" name="sandbox_check" value="1" class="selectgroup-input"
                    <?php echo e($phonePeInfo['sandbox_check'] == 1 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button">Active</span>
                </label>
                <label class="selectgroup-item">
                  <input type="radio" name="sandbox_check" value="0" class="selectgroup-input"
                    <?php echo e($phonePeInfo['sandbox_check'] == 0 ? 'checked' : ''); ?>>
                  <span class="selectgroup-button">Deactive</span>
                </label>
              </div>
            </div>

            <div class="form-group">
              <label>PhonePe MerchantId</label>
              <input class="form-control" name="merchant_id" value="<?php echo e($phonePeInfo['merchant_id']); ?>">
              <?php if($errors->has('merchant_id')): ?>
                <p class="mb-0 text-danger"><?php echo e($errors->first('merchant_id')); ?></p>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label>PhonePe Salt Key</label>
              <input class="form-control" name="salt_key" value="<?php echo e($phonePeInfo['salt_key']); ?>">
              <?php if($errors->has('salt_key')): ?>
                <p class="mb-0 text-danger"><?php echo e($errors->first('salt_key')); ?></p>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label>PhonePe Salt Index</label>
              <input class="form-control" name="salt_index" value="<?php echo e($phonePeInfo['salt_index']); ?>">
              <?php if($errors->has('salt_index')): ?>
                <p class="mb-0 text-danger"><?php echo e($errors->first('salt_index')); ?></p>
              <?php endif; ?>
            </div>
          </div>

          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form class="" action="<?php echo e(route('admin.anet.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title">Authorize.Net</div>
              </div>
            </div>
          </div>


          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-12">
                <?php echo csrf_field(); ?>
                <?php
                  $anetInfo = json_decode($anet->information, true);
                ?>
                <div class="form-group">
                  <label>Authorize.Net</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($anet->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Active</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($anet->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Deactive</span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label>Authorize.Net Test Mode</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_check" value="1" class="selectgroup-input"
                        <?php echo e($anetInfo['sandbox_check'] == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Active</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="sandbox_check" value="0" class="selectgroup-input"
                        <?php echo e($anetInfo['sandbox_check'] == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Deactive</span>
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label>API Login ID</label>
                  <input class="form-control" name="login_id" value="<?php echo e($anetInfo['login_id']); ?>">
                  <?php if($errors->has('login_id')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('login_id')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label>Transaction Key</label>
                  <input class="form-control" name="transaction_key" value="<?php echo e($anetInfo['transaction_key']); ?>">
                  <?php if($errors->has('transaction_key')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('transaction_key')); ?></p>
                  <?php endif; ?>
                </div>

                <div class="form-group">
                  <label>Public Client Key</label>
                  <input class="form-control" name="public_key" value="<?php echo e($anetInfo['public_key']); ?>">
                  <?php if($errors->has('public_key')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('public_key')); ?></p>
                  <?php endif; ?>
                </div>

              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    
    <div class="col-lg-4">
      <div class="card">
        <form class="" action="<?php echo e(route('admin.paytm.update')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <div class="card-header">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-title">Paytm</div>
              </div>
            </div>
          </div>


          <div class="card-body pt-5 pb-5">
            <div class="row">
              <div class="col-lg-12">
                <?php echo csrf_field(); ?>
                <?php
                  $paytmInfo = json_decode($paytm->information, true);
                ?>
                <div class="form-group">
                  <label>Paytm</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="1" class="selectgroup-input"
                        <?php echo e($paytm->status == 1 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Active</span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="status" value="0" class="selectgroup-input"
                        <?php echo e($paytm->status == 0 ? 'checked' : ''); ?>>
                      <span class="selectgroup-button">Deactive</span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label>Paytm Environment</label>
                  <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                      <input type="radio" name="environment" value="local" class="selectgroup-input"
                        <?php echo e($paytmInfo['environment'] == 'local' ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Local')); ?></span>
                    </label>
                    <label class="selectgroup-item">
                      <input type="radio" name="environment" value="production" class="selectgroup-input"
                        <?php echo e($paytmInfo['environment'] == 'production' ? 'checked' : ''); ?>>
                      <span class="selectgroup-button"><?php echo e(__('Production')); ?></span>
                    </label>
                  </div>
                  <?php if($errors->has('environment')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('environment')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Paytm Merchant Key</label>
                  <input class="form-control" name="secret" value="<?php echo e($paytmInfo['secret']); ?>">
                  <?php if($errors->has('secret')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('secret')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Paytm Merchant mid</label>
                  <input class="form-control" name="merchant" value="<?php echo e($paytmInfo['merchant']); ?>">
                  <?php if($errors->has('merchant')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('merchant')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Paytm Merchant website</label>
                  <input class="form-control" name="website" value="<?php echo e($paytmInfo['website']); ?>">
                  <?php if($errors->has('website')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('website')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label>Industry type id</label>
                  <input class="form-control" name="industry" value="<?php echo e($paytmInfo['industry']); ?>">
                  <?php if($errors->has('industry')): ?>
                    <p class="mb-0 text-danger"><?php echo e($errors->first('industry')); ?></p>
                  <?php endif; ?>
                </div>

              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="form">
              <div class="form-group from-show-notify row">
                <div class="col-12 text-center">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>




  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/installable/resources/views/admin/gateways/index.blade.php ENDPATH**/ ?>