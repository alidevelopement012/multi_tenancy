<?php use Illuminate\Support\Carbon; ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/front/css/membership-pdf.css')); ?>">
</head>
<body>
    <div class="main">
        <table class="heading">
            <tr>
                <td>
                    <?php if($bs->logo): ?>
                        <img loading="lazy" src="<?php echo e(asset('assets/front/img/'.$bs->logo)); ?>" height="40"
                            class="d-inline-block">
                    <?php else: ?>
                        <img loading="lazy" src="<?php echo e(asset('assets/admin/img/noimage.jpg')); ?>" height="40"
                            class="d-inline-block">
                    <?php endif; ?>
                </td>
                <td class="text-right strong invoice-heading">INVOICE</td>
            </tr>
        </table>
        <div class="header">
            <div class="ml-20">
                <table class="text-left">
                    <tr>
                        <td class="strong small gry-color">Bill to:</td>
                    </tr>
                    <tr>
                        <td class="strong"><?php echo e(ucfirst($member["first_name"]).' '.ucfirst($member["last_name"])); ?></td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Username: </strong><?php echo e($member["username"]); ?></td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Email: </strong> <?php echo e($member["email"]); ?></td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Phone: </strong> <?php echo e($phone); ?></td>
                    </tr>
                </table>
            </div>
            <div class="order-details">
                <table class="text-right">
                    <tr>
                        <td class="strong">Order Details:</td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Order ID:</strong> #<?php echo e($order_id); ?></td>
                    </tr>
                    <?php if($membership->discount > 0): ?>
                        <tr>
                            <td class="gry-color small"><strong>Package
                                    Price:</strong> <?php echo e($membership->package_price == 0 ? "Free": $membership->package_price); ?>

                            </td>
                        </tr>
                        <tr>
                            <td class="gry-color small"><strong>Discount:</strong> -<span
                                    ><?php echo e($membership->discount); ?></span></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="gry-color small"><strong>Total:</strong> <?php echo e($amount); ?></td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Payment Method:</strong> <?php echo e($request['payment_method']); ?></td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Payment Status:</strong>Completed</td>
                    </tr>
                    <tr>
                        <td class="gry-color small"><strong>Order Date:</strong> <?php echo e(Carbon::now()->format('d/m/Y')); ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="package-info">
            <table class="padding text-left small border-bottom">
                <thead>
                <tr class="gry-color info-titles">
                    <th width="20%">Package Title</th>
                    <th width="20%">Start Date</th>
                    <th width="20%">Expire Date</th>
                    <th width="20%">Currency</th>
                    <th width="20%">Total</th>
                </tr>
                </thead>
                <tbody class="strong">

                <tr class="text-center">
                    <td><?php echo e($package_title); ?></td>
                    <td><?php echo e($request['start_date']); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($request['expire_date'])->format('Y') == "9999" ? "Lifetime" : $request['expire_date']); ?></td>
                    <td><?php echo e($base_currency_text); ?></td>
                    <td>
                        <?php echo e($amount == 0 ? "Free": $amount); ?>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <table class="mt-80">
            <tr>
                <td class="text-right regards">Thanks & Regards,</td>
            </tr>
            <tr>
                <td class="text-right strong regards"><?php echo e($bs->website_title); ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
<?php /**PATH /Users/muhammadusman/Sites/eorder-31nulled/codecanyon-50718143-eorder-multitenant-restaurant-food-ordering-website-saas/new-project/resources/views/pdf/membership.blade.php ENDPATH**/ ?>