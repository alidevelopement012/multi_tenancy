<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileUploaderController;
use App\Http\Controllers\Admin\GatewayController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PaymentLogController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RegisterUserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SummernoteController;
use App\Http\Controllers\Admin\TenantController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/change-theme', [DashboardController::class, 'changeTheme'])->name('admin.theme.change');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/edit/profile', [ProfileController::class, 'editProfile'])->name('admin.edit.profile');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('admin.update.profile');
Route::get('/changePassword', [ProfileController::class, 'changePass'])->name('admin.change.password');
Route::post('/profile/updatePassword', [ProfileController::class, 'updatePassword'])->name('admin.update.password');


Route::post('/summernote/upload', [SummernoteController::class, 'upload'])->name('admin.summernote.upload');


Route::group(['middleware' => 'checkpermission:Role Management'], function () {

    Route::get('/roles', [RoleController::class, 'index'])->name('admin.role.index');
    Route::post('/role/store', [RoleController::class, 'store'])->name('admin.role.store');
    Route::post('/role/update', [RoleController::class, 'update'])->name('admin.role.update');
    Route::post('/role/delete', [RoleController::class, 'delete'])->name('admin.role.delete');
    Route::get('role/{id}/permissions/manage', [RoleController::class, 'managePermissions'])->name('admin.role.permissions.manage');
    Route::post('role/permissions/update', [RoleController::class, 'updatePermissions'])->name('admin.role.permissions.update');
});

Route::group(['middleware' => 'checkpermission:Admins Management'], function () {
    Route::get('/tenants', [TenantController::class, 'index'])->name('admin.tenant.index');
    Route::post('/tenant/store', [TenantController::class, 'store'])->name('admin.tenant.store');
    Route::get('/tenant/{id}/edit', [TenantController::class, 'edit'])->name('admin.tenant.edit');
    Route::post('/tenant/update', [TenantController::class, 'update'])->name('admin.tenant.update');
    Route::post('/tenant/delete', [TenantController::class, 'delete'])->name('admin.tenant.delete');
});


Route::group(['middleware' => 'checkpermission:Packages'], function () {

    Route::get('packages', [PackageController::class, 'index'])->name('admin.package.index');
    Route::post('package/upload', [PackageController::class, 'upload'])->name('admin.package.upload');
    Route::post('package/store', [PackageController::class, 'store'])->name('admin.package.store');
    Route::get('package/{id}/edit', [PackageController::class, 'edit'])->name('admin.package.edit');
    Route::post('package/update', [PackageController::class, 'update'])->name('admin.package.update');
    Route::post('package/{id}/uploadUpdate', [PackageController::class, 'uploadUpdate'])->name('admin.package.uploadUpdate');
    Route::post('package/delete', [PackageController::class, 'delete'])->name('admin.package.delete');
    Route::post('package/bulk-delete', [PackageController::class, 'bulkDelete'])->name('admin.package.bulk.delete');

    Route::get('/coupon', [CouponController::class, 'index'])->name('admin.coupon.index');
    Route::post('/coupon/store', [CouponController::class, 'store'])->name('admin.coupon.store');
    Route::get('/coupon/{id}/edit', [CouponController::class, 'edit'])->name('admin.coupon.edit');
    Route::post('/coupon/update', [CouponController::class, 'update'])->name('admin.coupon.update');
    Route::post('/coupon/delete', [CouponController::class, 'delete'])->name('admin.coupon.delete');
});


Route::group(['middleware' => 'checkpermission:Payment Log'], function () {

    Route::get('/payment-log', [PaymentLogController::class, 'index'])->name('admin.payment-log.index');
    Route::post('/payment-log/update', [PaymentLogController::class, 'update'])->name('admin.payment-log.update');
});

// Route::group(['middleware' => 'checkpermission:File Upload'], function () {

Route::get('/file-upload', [FileUploaderController::class, 'index'])->name('admin.fileupload.index');
Route::post('/file-upload', [FileUploaderController::class, 'store'])->name('admin.fileupload.store');
Route::delete('/file-upload/{id}', [FileUploaderController::class, 'destroy'])->name('admin.fileupload.delete');
// });



Route::get('slots', [ScheduleController::class, 'index'])->name('admin.slots.index');
Route::get('slots/create', [ScheduleController::class, 'create'])->name('admin.slots.create');
Route::post('slots', [ScheduleController::class, 'store'])->name('admin.slots.store');
Route::get('slots/{slot}/edit', [ScheduleController::class, 'edit'])->name('admin.slots.edit');
Route::put('slots/{slot}', [ScheduleController::class, 'update'])->name('admin.slots.update');
Route::delete('slots/{slot}', [ScheduleController::class, 'destroy'])->name('admin.slots.destroy');


// public booking
Route::get('booking/calendar', [BookingController::class, 'indexCalendar'])->name('admin.booking.calendar');
Route::get('bookings', [BookingController::class, 'index'])->name('admin.booking.index');
Route::post('booking/check-availability', [BookingController::class, 'checkAvailability'])->name('admin.booking.check');
Route::post('booking/book', [BookingController::class, 'book'])->name('admin.booking.book');
Route::post('booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('admin.booking.cancel');

Route::group(['middleware' => 'checkpermission:Payment Gateways'], function () {

    Route::get('/gateways', [GatewayController::class, 'index'])->name('admin.gateway.index');
    Route::post('/stripe/update', [GatewayController::class, 'stripeUpdate'])->name('admin.stripe.update');
    Route::post('/anet/update', [GatewayController::class, 'anetUpdate'])->name('admin.anet.update');
    Route::post('/paypal/update', [GatewayController::class, 'paypalUpdate'])->name('admin.paypal.update');
    Route::post('/paystack/update', [GatewayController::class, 'paystackUpdate'])->name('admin.paystack.update');
    Route::post('/paytm/update', [GatewayController::class, 'paytmUpdate'])->name('admin.paytm.update');
    Route::post('/flutterwave/update', [GatewayController::class, 'flutterwaveUpdate'])->name('admin.flutterwave.update');
    Route::post('/instamojo/update', [GatewayController::class, 'instamojoUpdate'])->name('admin.instamojo.update');
    Route::post('/mollie/update', [GatewayController::class, 'mollieUpdate'])->name('admin.mollie.update');
    Route::post('/razorpay/update', [GatewayController::class, 'razorpayUpdate'])->name('admin.razorpay.update');
    Route::post('/mercadopago/update', [GatewayController::class, 'mercadopagoUpdate'])->name('admin.mercadopago.update');

    Route::post('/yoco/update', [GatewayController::class, 'yocoUpdate'])->name('admin.yoco.update');
    Route::post('/xendit/update', [GatewayController::class, 'xenditUpdate'])->name('admin.xendit.update');
    Route::post('/perfect_money/update', [GatewayController::class, 'perfect_moneyUpdate'])->name('admin.perfect_money.update');
    Route::post('/midtrans/update', [GatewayController::class, 'midtransUpdate'])->name('admin.midtrans.update');
    Route::post('/myfatoorah/update', [GatewayController::class, 'myfatoorahUpdate'])->name('admin.myfatoorah.update');
    Route::post('/iyzico/update', [GatewayController::class, 'iyzicoUpdate'])->name('admin.iyzico.update');
    Route::post('/toyyibpay/update', [GatewayController::class, 'toyyibpayUpdate'])->name('admin.toyyibpay.update');
    Route::post('/paytabs/update', [GatewayController::class, 'paytabsUpdate'])->name('admin.paytabs.update');
    Route::post('/phonepe/update', [GatewayController::class, 'phonepeUpdate'])->name('admin.phonepe.update');


    Route::get('/offline/gateways', [GatewayController::class, 'offline'])->name('admin.gateway.offline');
    Route::post('/offline/gateway/store', [GatewayController::class, 'store'])->name('admin.gateway.offline.store');
    Route::post('/offline/gateway/update', [GatewayController::class, 'update'])->name('admin.gateway.offline.update');
    Route::post('/offline/status', [GatewayController::class, 'status'])->name('admin.offline.status');
    Route::post('/offline/gateway/delete', [GatewayController::class, 'delete'])->name('admin.offline.gateway.delete');
});

Route::group(['middleware' => 'checkpermission:Registered Users'], function () {

    Route::get('register/users', [RegisterUserController::class, 'index'])->name('admin.register.user');
    Route::post('register/user/store', [RegisterUserController::class, 'store'])->name('register.user.store');
    Route::post('register/users/ban', [RegisterUserController::class, 'userban'])->name('register.user.ban');
    Route::post('register/users/featured', [RegisterUserController::class, 'userFeatured'])->name('register.user.featured');
    Route::post('register/users/email', [RegisterUserController::class, 'emailStatus'])->name('register.user.email');
    Route::get('register/user/details/{id}', [RegisterUserController::class, 'view'])->name('register.user.view');
    Route::post('/user/current-package/remove', [RegisterUserController::class, 'removeCurrPackage'])->name('user.currPackage.remove');
    Route::post('/user/current-package/change', [RegisterUserController::class, 'changeCurrPackage'])->name('user.currPackage.change');
    Route::post('/user/current-package/add', [RegisterUserController::class, 'addCurrPackage'])->name('user.currPackage.add');
    Route::post('/user/next-package/remove', [RegisterUserController::class, 'removeNextPackage'])->name('user.nextPackage.remove');
    Route::post('/user/next-package/change', [RegisterUserController::class, 'changeNextPackage'])->name('user.nextPackage.change');
    Route::post('/user/next-package/add', [RegisterUserController::class, 'addNextPackage'])->name('user.nextPackage.add');
    Route::post('register/user/delete', [RegisterUserController::class, 'delete'])->name('register.user.delete');
    Route::post('register/user/bulk-delete', [RegisterUserController::class, 'bulkDelete'])->name('register.user.bulk.delete');
    Route::get('register/user/{id}/changePassword', [RegisterUserController::class, 'changePass'])->name('register.user.changePass');
    Route::post('register/user/updatePassword', [RegisterUserController::class, 'updatePassword'])->name('register.user.updatePassword');

    Route::post('register/users/template', [RegisterUserController::class, 'userTemplate'])->name('register.user.template');
    Route::post('register/users/template/update', [RegisterUserController::class, 'userUpdateTemplate'])->name('register.user.updateTemplate');

    Route::post('secret/user/login', [RegisterUserController::class, 'secretLogin'])->name('register.user.secretLogin')->withoutMiddleware('Demo');
});
