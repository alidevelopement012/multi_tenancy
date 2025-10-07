<?php

namespace App\Http\Controllers\Payment;

use Carbon\Carbon;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\PaymentGateway;
use Mollie\Laravel\Facades\Mollie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Helpers\UserPermissionHelper;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\User\UserCheckoutController;

class MollieController extends Controller
{

    protected $mollie, $key;
    private $information;
    public function __construct()
    {
        $data = PaymentGateway::query()
            ->where('keyword', 'mollie')
            ->first();
        $this->information = $data->information;

    }

    public function paymentProcess(Request $request, $_amount, $_success_url, $_cancel_url, $_title, $bex)
    {

        if (empty($this->information)) {

            session()->flash('error', 'Credentials are not set yet');
            return redirect()->back();
        }
        $notify_url = $_success_url;
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => $bex->base_currency_text,
                'value' => '' . sprintf('%0.2f', $_amount) . '', // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => $_title,
            'redirectUrl' => $notify_url,
        ]);

        /** add payment ID to session **/
        Session::put('request', $request->all());
        Session::put('payment_id', $payment->id);
        Session::put('success_url', $_success_url);

        $payment = Mollie::api()->payments()->get($payment->id);

        return redirect($payment->getCheckoutUrl(), 303);

    }

    public function successPayment(Request $request)
    {
        $requestData = Session::get('request');
        $cancel_url = Session::get('cancel_url');
        $payment_id = Session::get('payment_id');
        /** Get the payment ID before session clear **/

        $payment = Mollie::api()->payments()->get($payment_id);

        if ($payment->status == 'paid') {
            $paymentFor = Session::get('paymentFor');
            $package = Package::find($requestData['package_id']);
            $transaction_id = UserPermissionHelper::uniqueId(8);
            $transaction_details = json_encode($payment);
            if ($paymentFor == "membership") {
                $amount = $requestData['price'];
                $password = $requestData['password'];
                $checkout = new CheckoutController();
                $user = $checkout->store($requestData, $transaction_id, $transaction_details, $amount,'',$password);
                $lastMemb = $user->memberships()->orderBy('id', 'DESC')->first();
                $activation = Carbon::parse($lastMemb->start_date);
                $expire = Carbon::parse($lastMemb->expire_date);
                session()->flash('success', __('successful_payment'));
                Session::forget('request');
                Session::forget('paymentFor');
                return redirect()->route('success.page');
            }
            elseif($paymentFor == "extend") {
                $amount = $requestData['price'];
                $password = uniqid('qrcode');
                $checkout = new UserCheckoutController();
                $user = $checkout->store($requestData, $transaction_id, $transaction_details, $amount,'',$password);

                $lastMemb = $user->memberships()->orderBy('id', 'DESC')->first();
                $activation = Carbon::parse($lastMemb->start_date);
                $expire = Carbon::parse($lastMemb->expire_date);

                session()->flash('success', __('successful_payment'));
                Session::forget('request');
                Session::forget('paymentFor');
                return redirect()->route('success.page');
            }
        }
        return redirect($cancel_url);
    }

    public function cancelPayment()
    {
        $requestData = Session::get('request');
        $paymentFor = Session::get('paymentFor');
        session()->flash('error', __('cancel_payment'));
        if($paymentFor == "membership"){
            return redirect()->route('front.register.view',['status' => $requestData['package_type'],'id' => $requestData['package_id']])->withInput($requestData);
        }else{
            return redirect()->route('user.plan.extend.checkout',['package_id' => $requestData['package_id']])->withInput($requestData);
        }
    }
}
