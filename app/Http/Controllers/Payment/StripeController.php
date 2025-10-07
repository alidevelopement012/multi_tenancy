<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\User\UserCheckoutController;
use App\Http\Helpers\MegaMailer;
use App\Http\Helpers\UserPermissionHelper;
use App\Models\Language;
use App\Models\Package;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Models\PaymentGateway;
use Carbon\Carbon;

class StripeController extends Controller
{
    private $stripe_token;
    private $information;
    public function __construct()
    {
        //Set Spripe Keys
        $data = PaymentGateway::findOrFail(14);
        $this->information = $data->information;
        if (!is_null($data->information)) {
            $stripeConf = json_decode($data->information, true);
            Config::set('services.stripe.key', $stripeConf["key"]);
            Config::set('services.stripe.secret', $stripeConf["secret"]);
        } else {
            session()->flash('error', 'Credentials are not set yet');
            return back();
        }
    }

    public function paymentProcess(Request $request, $_amount, $_title, $_success_url, $_cancel_url)
    {

        if (is_null($this->information)) {

            session()->flash('error', 'Credentials are not set yet');
            return redirect()->back();
        }

        $this->stripe_token = $request->stripeToken;
        $title = $_title;
        $price = $_amount;
        $price = round($price, 2);
        $cancel_url = $_cancel_url;

        Session::put('request', $request->all());


        $stripe = Stripe::make(Config::get('services.stripe.secret'));
        try {

            if (!isset($request->stripeToken)) {
                return back()->with('error', 'Token Problem With Your Token.');
            }

            $charge = $stripe->charges()->create([
                'card' => $request->stripeToken,
                'receipt_email' => $request->email,
                'currency' =>  "USD",
                'amount' => $price,
                'description' => $title,
                'metadata' => [
                    'customer_name' => $request->username,
                ]
            ]);


            if ($charge['status'] == 'succeeded') {
                $paymentFor = Session::get('paymentFor');
                $package = Package::find($request->package_id);
                $transaction_id = UserPermissionHelper::uniqueId(8);
                $transaction_details = json_encode($charge);

                if ($paymentFor == "membership") {
                    $amount = $request->price;
                    $password = $request->password;
                    $checkout = new CheckoutController();
                    $user = $checkout->store($request, $transaction_id, $transaction_details, $amount, '', $password);


                    $lastMemb = $user->memberships()->orderBy('id', 'DESC')->first();
                    $activation = Carbon::parse($lastMemb->start_date);
                    $expire = Carbon::parse($lastMemb->expire_date);

                    session()->flash('success', __('successful_payment'));
                    Session::forget('request');
                    Session::forget('paymentFor');
                    return redirect()->route('success.page');
                } elseif ($paymentFor == "extend") {
                    $amount = $request['price'];
                    $password = uniqid('qrcode');
                    $checkout = new UserCheckoutController();
                    $user = $checkout->store($request, $transaction_id, $transaction_details, $amount, '', $password);

                    $lastMemb = $user->memberships()->orderBy('id', 'DESC')->first();
                    $activation = Carbon::parse($lastMemb->start_date);
                    $expire = Carbon::parse($lastMemb->expire_date);

                    session()->flash('success', __('successful_payment'));
                    Session::forget('request');
                    Session::forget('paymentFor');
                    return redirect()->route('success.page');
                }
            }
        } catch (\Exception $e) {
            return redirect($cancel_url)->with('error', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            return redirect($cancel_url)->with('error', $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            return redirect($cancel_url)->with('error', $e->getMessage());
        }
        return redirect($cancel_url)->with('error', 'Please Enter Valid Credit Card Informations.');
    }

    public function cancelPayment()
    {
        $requestData = Session::get('request');
        $paymentFor = Session::get('paymentFor');
        session()->flash('error', __('cancel_payment'));
        if ($paymentFor == "membership") {
            return redirect()->route('front.register.view', ['status' => $requestData['package_type'], 'id' => $requestData['package_id']])->withInput($requestData);
        } else {
            return redirect()->route('user.plan.extend.checkout', ['package_id' => $requestData['package_id']])->withInput($requestData);
        }
    }
}
