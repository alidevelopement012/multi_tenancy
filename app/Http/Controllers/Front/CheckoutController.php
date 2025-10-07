<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Package;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\OfflineGateway;
use App\Models\User\PaymentGateway;
use App\Models\User\UserPermission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Helpers\UserPermissionHelper;
use App\Http\Controllers\Payment\MollieController;
use App\Http\Controllers\Payment\PaypalController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\Payment\FlutterWaveController;
use App\Http\Controllers\Payment\AuthorizenetController;
use App\Http\Controllers\Payment\PerfectMoneyController;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $coupon = Coupon::where('code', Session::get('coupon'))->first();
        if (!empty($coupon)) {
            $coupon_count = $coupon->total_uses;
            if ($coupon->maximum_uses_limit != 999999) {
                if ($coupon_count == $coupon->maximum_uses_limit) {
                    Session::forget('coupon');
                    session()->flash('warning', __('This coupon reached maximum limit'));
                    return redirect()->back();
                }
            }
        }

        $offline_payment_gateways = OfflineGateway::all()->pluck('name')->toArray();
        $request['status'] = 1;
        $request['mode'] = 'online';
        $request['receipt_name'] = null;
        Session::put('paymentFor', 'membership');
        $title = "You are purchasing a membership";
        $description = "Congratulation you are going to join our membership.Please make a payment for confirming your membership now!";
        if ($request->package_type == "trial") {
            $package = Package::find($request['package_id']);
            $request['price'] = 0.00;
            $request['payment_method'] = "-";
            $transaction_id = UserPermissionHelper::uniqueId(8);
            $transaction_details = "Trial";
            $user = $this->store(
                $request->all(),
                $transaction_id,
                $transaction_details,
                $request->price,
                $request->password
            );

            $lastMemb = $user->memberships()->orderBy('id', 'DESC')->first();
            $activation = Carbon::parse($lastMemb->start_date);
            $expire = Carbon::parse($lastMemb->expire_date);

            session()->flash('success', __('successful_payment'));
            return redirect()->route('membership.trial.success');
        } elseif ($request->price == 0) {
            $package = Package::find($request['package_id']);
            $request['price'] = 0.00;
            $request['payment_method'] = "-";
            $transaction_id = UserPermissionHelper::uniqueId(8);
            $transaction_details = "Free";
            $user = $this->store($request->all(), $transaction_id, $transaction_details, $request->price, '', $request->password);

            $lastMemb = $user->memberships()->orderBy('id', 'DESC')->first();

            session()->flash('success', __('successful_payment'));
            return redirect()->route('success.page');
        } elseif ($request->payment_method == "Paypal") {
            $amount = round($request->price, 2);
            $paypal = new PaypalController();
            $cancel_url = route('membership.paypal.cancel');
            $success_url = route('membership.paypal.success');
            return $paypal->paymentProcess($request, $amount, $title, $success_url, $cancel_url);
        } elseif ($request->payment_method == "Stripe") {
            $amount = round($request->price, 2);
            $stripe = new StripeController();
            $cancel_url = route('membership.stripe.cancel');
            return $stripe->paymentProcess($request, $amount, $title, NULL, $cancel_url);
        } elseif ($request->payment_method == "Flutterwave") {
            $available_currency = array(
                'BIF',
                'CAD',
                'CDF',
                'CVE',
                'EUR',
                'GBP',
                'GHS',
                'GMD',
                'GNF',
                'KES',
                'LRD',
                'MWK',
                'NGN',
                'RWF',
                'SLL',
                'STD',
                'TZS',
                'UGX',
                'USD',
                'XAF',
                'XOF',
                'ZMK',
                'ZMW',
                'ZWD'
            );
            $amount = round($request->price, 2);
            $email = $request->email;
            $item_number = uniqid('flutterwave-') . time();
            $cancel_url = route('membership.flutterwave.cancel');
            $success_url = route('membership.flutterwave.success');
            $flutterWave = new FlutterWaveController();
            return $flutterWave->paymentProcess($request, $amount, $email, $item_number, $success_url, $cancel_url, '');
        } elseif ($request->payment_method == "Authorize.net") {
            $available_currency = array('USD', 'CAD', 'CHF', 'DKK', 'EUR', 'GBP', 'NOK', 'PLN', 'SEK', 'AUD', 'NZD');
            $amount = $request->price;
            $cancel_url = route('membership.anet.cancel');
            $anetPayment = new AuthorizenetController();
            return $anetPayment->paymentProcess($request, $amount, $cancel_url, $title, '');
        } elseif ($request->payment_method == "Mollie Payment") {
            $available_currency = array('AED', 'AUD', 'BGN', 'BRL', 'CAD', 'CHF', 'CZK', 'DKK', 'EUR', 'GBP', 'HKD', 'HRK', 'HUF', 'ILS', 'ISK', 'JPY', 'MXN', 'MYR', 'NOK', 'NZD', 'PHP', 'PLN', 'RON', 'RUB', 'SEK', 'SGD', 'THB', 'TWD', 'USD', 'ZAR');
            $amount = round($request->price, 2);
            $success_url = route('membership.mollie.success');
            $cancel_url = route('membership.mollie.cancel');
            $molliePayment = new MollieController();
            return $molliePayment->paymentProcess($request, $amount, $success_url, $cancel_url, $title, '');
        } elseif ($request->payment_method == "Perfect Money") {
            $available_currency = array('USD');
            $amount = round($request->price, 2);
            $success_url = route('membership.perfect_money.success');
            $cancel_url = route('membership.cancel');
            $payment = new PerfectMoneyController();
            return $payment->paymentProcess($request, $amount, $success_url, $cancel_url, '', '');
        } elseif (in_array($request->payment_method, $offline_payment_gateways)) {
            $request['mode'] = 'offline';
            $request['status'] = 0;
            $request['receipt_name'] = null;
            if ($request->has('receipt')) {
                $filename = time() . '.' . $request->file('receipt')->getClientOriginalExtension();
                $directory = "./assets/front/img/membership/receipt";
                if (!file_exists($directory)) mkdir($directory, 0775, true);
                $request->file('receipt')->move($directory, $filename);
                $request['receipt_name'] = $filename;
            }
            $amount = round($request->price, 2);
            $transaction_id = UserPermissionHelper::uniqueId(8);
            $transaction_details = "offline";
            $password = $request->password;

            $this->store($request->all(), $transaction_id, json_encode($transaction_details), $amount, '', $password);
            session()->flash('success', __('successful_payment'));
            return redirect()->route('membership.offline.success');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(
        $request,
        $transaction_id,
        $transaction_details,
        $amount,
        $password
    ) {
        $token = md5(time() . $request['username'] . $request['email']);
        $verification_link = "<a href='" . url('user/register/mode/' . $request['mode'] . '/verify/' . $token) . "'>" . "<button type=\"button\" class=\"btn btn-primary\">Click Here</button>" . "</a>";

        $userData = User::query()->where('username', $request['username']);
        if ($userData->count() == 0) {
            $user = User::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'username' => $request['username'],
                'password' => bcrypt($password),
                'status' => $request["status"],
                'address' => $request["address"] ? $request["address"] : null,
                'city' => $request["city"] ? $request["city"] : null,
                'state' => $request["district"] ? $request["district"] : null,
                'country' => $request["country"] ? $request["country"] : null,
                'verification_link' => $token,
            ]);

            // create payment gateways
            $payment_keywords = ['flutterwave', 'razorpay', 'paytm', 'paystack', 'instamojo', 'stripe', 'paypal', 'mollie', 'mercadopago', 'authorize.net'];
            foreach ($payment_keywords as $key => $value) {
                PaymentGateway::create([
                    'title' => null,
                    'user_id' => $user->id,
                    'details' => null,
                    'keyword' => $value,
                    'subtitle' => null,
                    'name' => ucfirst($value),
                    'type' => 'automatic',
                    'information' => null
                ]);
            }

            $package = Package::query()->findOrFail($request['package_id']);

            Membership::create([
                'package_price' => $package->price,
                'discount' => session()->has('coupon_amount') ? session()->get('coupon_amount') : 0,
                'coupon_code' => session()->has('coupon') ? session()->get('coupon') : NULL,
                'price' => $amount,
                'currency' => "USD",
                'currency_symbol' => '$',
                'payment_method' => $request["payment_method"],
                'transaction_id' => $transaction_id ?? 0,
                'status' => $request["status"] ? $request["status"] : 0,
                'is_trial' => $request["package_type"] == "regular" ? 0 : 1,
                'trial_days' => $request["package_type"] == "regular" ? 0 : $request["trial_days"],
                'receipt' => $request["receipt_name"] ? $request["receipt_name"] : null,
                'transaction_details' => $transaction_details ?? null,
                'settings' => '',
                'package_id' => $request['package_id'],
                'user_id' => $user->id,
                'start_date' => Carbon::parse($request['start_date']),
                'expire_date' => Carbon::parse($request['expire_date']),
                'conversation_id' => ''
            ]);
            $features = json_decode($package->features, true);
            $features[] = "Contact";
            UserPermission::create([
                'package_id' => $request['package_id'],
                'user_id' => $user->id,
                'permissions' => json_encode($features)
            ]);
        }
        // coupon update
        if (Session::has('coupon')) {
            $coupon = Coupon::query()->where('code', Session::get('coupon'))->first();
            $coupon->total_uses = $coupon->total_uses + 1;
            $coupon->save();
        }
        return $user;
    }


    public function onlineSuccess()
    {
        Session::forget('coupon');
        Session::forget('coupon_amount');
        return view('front.success');
    }

    public function offlineSuccess()
    {
        Session::forget('coupon');
        Session::forget('coupon_amount');
        return view('front.offline-success');
    }

    public function trialSuccess()
    {
        Session::forget('coupon');
        Session::forget('coupon_amount');
        return view('front.trial-success');
    }

    public function coupon(Request $request)
    {
        if (session()->has('coupon')) {
            return 'Coupon already applied';
        }
        $coupon = Coupon::where('code', $request->coupon)->first();
        if (empty($coupon)) {
            return 'This coupon does not exist';
        }

        $coupon_count = $coupon->total_uses;
        if ($coupon->maximum_uses_limit != 999999) {
            if ($coupon_count >= $coupon->maximum_uses_limit) {
                return 'This coupon reached maximum limit';
            }
        }
        $start = Carbon::parse($coupon->start_date);
        $end = Carbon::parse($coupon->end_date);
        $today = Carbon::parse(Carbon::now()->format('m/d/Y'));
        $packages = $coupon->packages;
        $packages = json_decode($packages, true);
        $packages = !empty($packages) ? $packages : [];
        if (!in_array($request->package_id, $packages)) {
            return 'This coupon is not valid for this package';
        }

        if ($today->greaterThanOrEqualTo($start) && $today->lessThanOrEqualTo($end)) {
            $package = Package::find($request->package_id);
            $price = $package->price;
            if ($coupon->type == 'percentage') {
                $cAmount = ($price * $coupon->value) / 100;
            } else {
                $cAmount = $coupon->value;
            }
            Session::put('coupon', $request->coupon);
            Session::put('coupon_amount', round($cAmount, 2));
            return "success";
        } else {
            return 'This coupon does not exist';
        }
    }

    public function cancel()
    {
        $request = Session::get('request');
        $paymentFor = Session::get('paymentFor');
        if ($paymentFor == "membership") {
            return redirect()->route('front.register.view', ['status' => $request['package_type'], 'id' => $request['package_id']])->withInput($request);
        } else {
            return redirect()->route('user.plan.extend.checkout', ['package_id' => $request['package_id']])->withInput($request);
        }
    }
}
