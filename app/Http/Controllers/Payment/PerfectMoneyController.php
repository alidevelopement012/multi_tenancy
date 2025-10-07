<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\User\UserCheckoutController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Helpers\UserPermissionHelper;
use App\Models\Package;
use App\Http\Helpers\MegaMailer;
use App\Models\Language;
use Carbon\Carbon;

class PerfectMoneyController extends Controller
{
    private $information;

    public function __construct()
    {
        $data = PaymentGateway::whereKeyword('perfect_money')->first();
        $this->information = $data->convertAutoData();
    }

    public function paymentProcess(Request $request, $_amount, $_success_url, $_cancel_url, $be, $bs)
    {
        if (is_null($this->information)) {
            session()->flash('error', 'Credentials are not set yet');
            return redirect()->back();
        }

        $price = $_amount;
        $price = round($price, 2); //live amount
        // $price = 0.01; //test amount
        $randomNo = substr(uniqid(), 0, 8);

        /*******************************************************
         ****************** Payment Gateway Info ******************
         ********************************************************/
        $val['PAYEE_ACCOUNT'] = $this->information['perfect_money_wallet_id'];;
        $val['PAYEE_NAME'] = $bs->website_title;
        $val['PAYMENT_ID'] = "$randomNo"; //random id
        $val['PAYMENT_AMOUNT'] = $price;
        $val['PAYMENT_UNITS'] = "$be->base_currency_text";

        $val['STATUS_URL'] = $_success_url;
        $val['PAYMENT_URL'] = $_success_url;
        $val['PAYMENT_URL_METHOD'] = 'GET';
        $val['NOPAYMENT_URL'] = $_cancel_url;
        $val['NOPAYMENT_URL_METHOD'] = 'GET';
        $val['SUGGESTED_MEMO'] = "$request->email";
        $val['BAGGAGE_FIELDS'] = 'IDENT';

        $data['val'] = $val;
        $data['method'] = 'post';
        $data['url'] = 'https://perfectmoney.com/api/step1.asp';

        Session::put('payment_id', $randomNo);
        Session::put('cancel_url', $_cancel_url);
        Session::put('amount', $price);
        Session::put('request', $request->all());
        return view('payments.perfect-money', compact('data'));
    }

    public function successPayment(Request $request)
    {
        $requestData = Session::get('request');
        /** clear the session payment ID **/
        $cancel_url = route('membership.cancel');
        $amo = $request['PAYMENT_AMOUNT'];
        $track = $request['PAYMENT_ID'];
        $id = Session::get('payment_id');
        $final_amount = Session::get('amount');

        if ($request->PAYEE_ACCOUNT == $this->information['perfect_money_wallet_id']  && $track == $id && $amo == round($final_amount, 2)) {
            $paymentFor = Session::get('paymentFor');
            $package = Package::find($requestData['package_id']);
            $transaction_id = UserPermissionHelper::uniqueId(8);
            $transaction_details = json_encode($request->all());
            if ($paymentFor == "membership") {
                $amount = $requestData['price'];
                $password = $requestData['password'];
                $checkout = new CheckoutController();
                $user = $checkout->store($requestData, $transaction_id, $transaction_details, $amount, '', $password);

                $lastMemb = $user->memberships()->orderBy('id', 'DESC')->first();
                $activation = Carbon::parse($lastMemb->start_date);
                $expire = Carbon::parse($lastMemb->expire_date);

                session()->flash('success', __('successful_payment'));
                return redirect()->route('success.page');
            } elseif ($paymentFor == "extend") {
                $amount = $requestData['price'];
                $password = uniqid('qrcode');
                $checkout = new UserCheckoutController();
                $user = $checkout->store($requestData, $transaction_id, $transaction_details, $amount, '', $password);


                $lastMemb = $user->memberships()->orderBy('id', 'DESC')->first();
                $activation = Carbon::parse($lastMemb->start_date);
                $expire = Carbon::parse($lastMemb->expire_date);
                return redirect()->route('success.page');
            }
        }
        return redirect($cancel_url);
    }
}
