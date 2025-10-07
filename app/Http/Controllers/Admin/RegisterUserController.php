<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Constant;
use App\Http\Helpers\Uploader;
use App\Models\User\BasicExtra;
use App\Models\BasicSetting;
use App\Models\BasicExtended;
use App\Models\User\CustomPage\Page;
use App\Models\User\CustomPage\PageContent;
use App\Models\User\Journal\Blog;
use App\Models\User\Journal\BlogInformation;
use App\Models\User\OrderTime;
use App\Models\User\Product;
use App\Models\User\ProductInformation;
use App\Models\User\ServingMethod;
use App\Rules\ImageMimeTypeRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Helpers\MegaMailer;
use App\Http\Helpers\UserPermissionHelper;
use App\Models\Membership;
use App\Models\OfflineGateway;
use App\Models\Package;
use App\Models\PaymentGateway;
use App\Models\User\PaymentGateway as UserPaymentGateway;
use App\Models\User;
use App\Models\User\Language;
use App\Models\User\Menu;
use App\Models\User\PageHeading;
use App\Models\User\UserPermission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use function Clue\StreamFilter\fun;

class RegisterUserController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->term;
        $users = User::query()
            ->when($term, function ($query, $term) {
                $query->where('username', 'like', '%' . $term . '%')
                    ->orWhere('email', 'like', '%' . $term . '%');
            })
            ->whereNull('admin_id')
            ->orderBy('id', 'ASC')
            ->paginate(10);

        $online = PaymentGateway::query()->where('status', 1)->get();
        $offline = OfflineGateway::query()->where('status', 1)->get();
        $gateways = $online->merge($offline);
        $packages = Package::query()->where('status', '1')->get();
        return view('admin.register_user.index', compact('users', 'gateways', 'packages'));
    }

    public function view($id)
    {
        $user = User::query()->findOrFail($id);
        $packages = Package::query()->where('status', '1')->get();
        $online = PaymentGateway::query()->where('status', 1)->get();
        $offline = OfflineGateway::where('status', 1)->get();
        $gateways = $online->merge($offline);
        return view('admin.register_user.details', compact('user', 'packages', 'gateways'));
    }

    public function store(Request $request)
    {

        $rules = [
            'username' => 'required|alpha_num|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'package_id' => 'required',
            'payment_gateway' => 'required',
            'online_status' => 'required'
        ];

        $messages = [
            'package_id.required' => 'The package field is required',
            'online_status.required' => 'The publicly hidden field is required'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $user = User::query()->where('username', $request['username']);
        if ($user->count() == 0) {
            $user = User::create([
                'email' => $request['email'],
                'username' => $request['username'],
                'password' => bcrypt($request['password']),
                'online_status' => $request["online_status"],
                'status' => 1,
                'email_verified' => 1,
            ]);
        }

        if ($user) {
            $checkoutController = new CheckoutController;
            $checkoutController->insertMailTemplate($user);


            // create payment gateways
            $payment_keywords = ['flutterwave', 'razorpay', 'paytm', 'paystack', 'instamojo', 'stripe', 'paypal', 'mollie', 'mercadopago', 'authorize.net'];
            foreach ($payment_keywords as $key => $value) {
                UserPaymentGateway::create([
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

            $package = Package::query()->find($request['package_id']);
            $transaction_id = UserPermissionHelper::uniqueId(8);

            $startDate = Carbon::today()->format('Y-m-d');
            if ($package->term === "month") {
                $endDate = Carbon::today()->addMonth()->format('Y-m-d');
            } elseif ($package->term === "year") {
                $endDate = Carbon::today()->addYear()->format('Y-m-d');
            } elseif ($package->term === "lifetime") {
                $endDate = Carbon::maxValue()->format('d-m-Y');
            }

            $memb = Membership::create([
                'price' => $package->price,
                'currency' => "USD",
                'currency_symbol' => '$',
                'payment_method' => $request["payment_gateway"],
                'transaction_id' => $transaction_id ? $transaction_id : 0,
                'status' => 1,
                'is_trial' => 0,
                'trial_days' => 0,
                'receipt' => $request["receipt_name"] ? $request["receipt_name"] : null,
                'transaction_details' => null,
                'settings' => '',
                'package_id' => $request['package_id'],
                'user_id' => $user->id,
                'start_date' => Carbon::parse($startDate),
                'expire_date' => Carbon::parse($endDate),
            ]);
            $package = Package::query()->findOrFail($request['package_id']);
            $features = json_decode($package->features, true);
            $features[] = "Contact";
            UserPermission::create([
                'package_id' => $request['package_id'],
                'user_id' => $user->id,
                'permissions' => json_encode($features)
            ]);
        }
        Session::flash('success', 'User added successfully!');
        return "success";
    }

    public function userban(Request $request)
    {
        $user = User::query()->where('id', $request->user_id)->first();

        $user->update([
            'status' => $request->status,
        ]);
        Session::flash('success', 'Status update successfully!');
        return back();
    }

    public function emailStatus(Request $request)
    {
        $user = User::query()->findOrFail($request->user_id);
        $user->update([
            'email_verified' => $request->email_verified,
        ]);
        Session::flash('success', 'Email status updated for ' . $user->username);
        return back();
    }

    public function userFeatured(Request $request)
    {
        $user = User::query()->where('id', $request->user_id)->first();
        $user->featured = $request->featured;
        $user->save();
        Session::flash('success', 'User featured update successfully!');
        return back();
    }

    public function changePass($id)
    {
        $data['user'] = User::query()->findOrFail($id);
        return view('admin.register_user.password', $data);
    }

    public function updatePassword(Request $request)
    {
        $messages = [
            'npass.required' => 'New password is required',
            'cfpass.required' => 'Confirm password is required',
        ];

        $request->validate([
            'npass' => 'required',
            'cfpass' => 'required',
        ], $messages);

        $user = User::query()->findOrFail($request->user_id);
        if ($request->npass == $request->cfpass) {
            $input['password'] = Hash::make($request->npass);
        } else {
            return back()->with('warning', __('Confirm password does not match.'));
        }
        $user->update($input);
        Session::flash('success', 'Password update for ' . $user->username);
        return back();
    }

    public function delete(Request $request)
    {

        $user = User::query()->findOrFail($request->user_id);
        $user->delete();
        Session::flash('success', 'User deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $user = User::query()->findOrFail($id);
            $user->delete();
        }
        Session::flash('success', 'Users deleted successfully!');
        return "success";
    }

    public function removeCurrPackage(Request $request)
    {
        $userId = $request->user_id;
        $user = User::findOrFail($userId);
        $currMembership = UserPermissionHelper::currMembOrPending($userId);
        $currPackage = Package::select('title')->findOrFail($currMembership->package_id);
        $nextMembership = UserPermissionHelper::nextMembership($userId);

        $today = Carbon::now();

        // just expire the current package
        $currMembership->expire_date = $today->subDay();
        $currMembership->modified = 1;
        if ($currMembership->status == 0) {
            $currMembership->status = 2;
        }
        $currMembership->save();

        // if next package exists
        if (!empty($nextMembership)) {
            $nextPackage = Package::find($nextMembership->package_id);

            $nextMembership->start_date = Carbon::parse(Carbon::today()->format('d-m-Y'));
            if ($nextPackage->term == 'month') {
                $nextMembership->expire_date = Carbon::parse(Carbon::today()->addMonth()->format('d-m-Y'));
            } elseif ($nextPackage->term == 'year') {
                $nextMembership->expire_date = Carbon::parse(Carbon::today()->addYear()->format('d-m-Y'));
            } elseif ($nextPackage->term == 'lifetime') {
                $nextMembership->expire_date = Carbon::parse(Carbon::maxValue()->format('d-m-Y'));
            }
            $nextMembership->save();

            $features = json_decode($nextPackage->features, true);
            $features[] = "Contact";
            UserPermission::where('user_id', $user->id)->update([
                'package_id' => $nextPackage->id,
                'user_id' => $user->id,
                'permissions' => json_encode($features)
            ]);
        }

        Session::flash('success', 'Current Package removed successfully!');
        return back();
    }


    public function changeCurrPackage(Request $request)
    {
        $userId = $request->user_id;
        $user = User::findOrFail($userId);
        $currMembership = UserPermissionHelper::currMembOrPending($userId);
        $nextMembership = UserPermissionHelper::nextMembership($userId);

        $selectedPackage = Package::find($request->package_id);


        // if the user has a next package to activate & selected package is 'lifetime' package
        if (!empty($nextMembership) && $selectedPackage->term == 'lifetime') {
            Session::flash('membership_warning', 'To add a Lifetime package as Current Package, You have to remove the next package');
            return back();
        }
        // expire the current package
        $currMembership->expire_date = Carbon::parse(Carbon::now()->subDay()->format('d-m-Y'));
        $currMembership->modified = 1;
        if ($currMembership->status == 0) {
            $currMembership->status = 2;
        }
        $currMembership->save();

        // calculate expire date for selected package
        if ($selectedPackage->term == 'month') {
            $exDate = Carbon::now()->addMonth()->format('d-m-Y');
        } elseif ($selectedPackage->term == 'year') {
            $exDate = Carbon::now()->addYear()->format('d-m-Y');
        } elseif ($selectedPackage->term == 'lifetime') {
            $exDate = Carbon::maxValue()->format('d-m-Y');
        }
        // store a new membership for selected package
        $selectedMemb = Membership::create([
            'price' => $selectedPackage->price,
            'currency' => 'USD',
            'currency_symbol' => '$',
            'payment_method' => $request->payment_method,
            'transaction_id' => uniqid(),
            'status' => 1,
            'receipt' => NULL,
            'transaction_details' => NULL,
            'settings' => '',
            'package_id' => $selectedPackage->id,
            'user_id' => $userId,
            'start_date' => Carbon::parse(Carbon::now()->format('d-m-Y')),
            'expire_date' => Carbon::parse($exDate),
            'is_trial' => 0,
            'trial_days' => 0,
        ]);

        $features = json_decode($selectedPackage->features, true);
        $features[] = "Contact";
        UserPermission::where('user_id', $user->id)->update([
            'package_id' => $request['package_id'],
            'user_id' => $user->id,
            'permissions' => json_encode($features)
        ]);

        // if the user has a next package to activate & selected package is not 'lifetime' package
        if (!empty($nextMembership) && $selectedPackage->term != 'lifetime') {
            $nextPackage = Package::find($nextMembership->package_id);

            // calculate & store next membership's start_date
            $nextMembership->start_date = Carbon::parse(Carbon::parse($exDate)->addDay()->format('d-m-Y'));

            // calculate & store expire date for next membership
            if ($nextPackage->term == 'month') {
                $exDate = Carbon::parse(Carbon::parse(Carbon::parse($exDate)->addDay()->format('d-m-Y'))->addMonth()->format('d-m-Y'));
            } elseif ($nextPackage->term == 'year') {
                $exDate = Carbon::parse(Carbon::parse(Carbon::parse($exDate)->addDay()->format('d-m-Y'))->addYear()->format('d-m-Y'));
            } else {
                $exDate = Carbon::parse(Carbon::maxValue()->format('d-m-Y'));
            }
            $nextMembership->expire_date = $exDate;
            $nextMembership->save();
        }

        $currentPackage = Package::select('title')->findOrFail($currMembership->package_id);

        Session::flash('success', 'Current Package changed successfully!');
        return back();
    }

    public function addCurrPackage(Request $request)
    {
        $userId = $request->user_id;
        $user = User::findOrFail($userId);

        $selectedPackage = Package::find($request->package_id);

        // calculate expire date for selected package
        if ($selectedPackage->term == 'month') {
            $exDate = Carbon::now()->addMonth()->format('d-m-Y');
        } elseif ($selectedPackage->term == 'year') {
            $exDate = Carbon::now()->addYear()->format('d-m-Y');
        } elseif ($selectedPackage->term == 'lifetime') {
            $exDate = Carbon::maxValue()->format('d-m-Y');
        }
        // store a new membership for selected package
        $selectedMemb = Membership::create([
            'price' => $selectedPackage->price,
            'currency' => 'USD',
            'currency_symbol' => '$',
            'payment_method' => $request->payment_method,
            'transaction_id' => uniqid(),
            'status' => 1,
            'receipt' => NULL,
            'transaction_details' => NULL,
            'settings' => '',
            'package_id' => $selectedPackage->id,
            'user_id' => $userId,
            'start_date' => Carbon::parse(Carbon::now()->format('d-m-Y')),
            'expire_date' => Carbon::parse($exDate),
            'is_trial' => 0,
            'trial_days' => 0,
        ]);

        $features = json_decode($selectedPackage->features, true);
        $features[] = "Contact";
        UserPermission::where('user_id', $user->id)->update([
            'package_id' => $request['package_id'],
            'user_id' => $user->id,
            'permissions' => json_encode($features)
        ]);

        Session::flash('success', 'Current Package has been added successfully!');
        return back();
    }

    public function removeNextPackage(Request $request)
    {
        $userId = $request->user_id;
        $user = User::findOrFail($userId);
        $nextMembership = UserPermissionHelper::nextMembership($userId);
        // set the start_date to unlimited
        $nextMembership->start_date = Carbon::parse(Carbon::maxValue()->format('d-m-Y'));
        $nextMembership->modified = 1;
        $nextMembership->save();

        $nextPackage = Package::select('title')->findOrFail($nextMembership->package_id);

        Session::flash('success', 'Next Package removed successfully!');
        return back();
    }

    public function changeNextPackage(Request $request)
    {
        $userId = $request->user_id;
        $user = User::findOrFail($userId);
        $nextMembership = UserPermissionHelper::nextMembership($userId);
        $nextPackage = Package::find($nextMembership->package_id);
        $selectedPackage = Package::find($request->package_id);

        $prevStartDate = $nextMembership->start_date;
        // set the start_date to unlimited
        $nextMembership->start_date = Carbon::parse(Carbon::maxValue()->format('d-m-Y'));
        $nextMembership->modified = 1;
        $nextMembership->save();

        // calculate expire date for selected package
        if ($selectedPackage->term == 'month') {
            $exDate = Carbon::parse($prevStartDate)->addMonth()->format('d-m-Y');
        } elseif ($selectedPackage->term == 'year') {
            $exDate = Carbon::parse($prevStartDate)->addYear()->format('d-m-Y');
        } elseif ($selectedPackage->term == 'lifetime') {
            $exDate = Carbon::parse(Carbon::maxValue()->format('d-m-Y'));
        }

        // store a new membership for selected package
        $selectedMemb = Membership::create([
            'price' => $selectedPackage->price,
            'currency' => 'USD',
            'currency_symbol' => '$',
            'payment_method' => $request->payment_method,
            'transaction_id' => uniqid(),
            'status' => 1,
            'receipt' => NULL,
            'transaction_details' => NULL,
            'settings' => '',
            'package_id' => $selectedPackage->id,
            'user_id' => $userId,
            'start_date' => Carbon::parse($prevStartDate),
            'expire_date' => Carbon::parse($exDate),
            'is_trial' => 0,
            'trial_days' => 0,
        ]);

        Session::flash('success', 'Next Package changed successfully!');
        return back();
    }

    public function addNextPackage(Request $request)
    {
        $userId = $request->user_id;

        $hasPendingMemb = UserPermissionHelper::hasPendingMembership($userId);
        if ($hasPendingMemb) {
            Session::flash('membership_warning', 'This user already has a Pending Package. Please take an action (change / remove / approve / reject) for that package first.');
            return back();
        }

        $currMembership = UserPermissionHelper::userPackage($userId);
        $currPackage = Package::find($currMembership->package_id);
        $user = User::findOrFail($userId);

        $selectedPackage = Package::find($request->package_id);

        if ($currMembership->is_trial == 1) {
            Session::flash('membership_warning', 'If your current package is trial package, then you have to change / remove the current package first.');
            return back();
        }


        // if current package is not lifetime package
        if ($currPackage->term != 'lifetime') {
            // calculate expire date for selected package
            if ($selectedPackage->term == 'month') {
                $exDate = Carbon::parse($currMembership->expire_date)->addDay()->addMonth()->format('d-m-Y');
            } elseif ($selectedPackage->term == 'year') {
                $exDate = Carbon::parse($currMembership->expire_date)->addDay()->addYear()->format('d-m-Y');
            } elseif ($selectedPackage->term == 'lifetime') {
                $exDate = Carbon::parse(Carbon::maxValue()->format('d-m-Y'));
            }
            // store a new membership for selected package
            $selectedMemb = Membership::create([
                'price' => $selectedPackage->price,
                'currency' => 'USD',
                'currency_symbol' => '$',
                'payment_method' => $request->payment_method,
                'transaction_id' => uniqid(),
                'status' => 1,
                'receipt' => NULL,
                'transaction_details' => NULL,
                'settings' => '',
                'package_id' => $selectedPackage->id,
                'user_id' => $userId,
                'start_date' => Carbon::parse(Carbon::parse($currMembership->expire_date)->addDay()->format('d-m-Y')),
                'expire_date' => Carbon::parse($exDate),
                'is_trial' => 0,
                'trial_days' => 0,
            ]);
        } else {
            Session::flash('membership_warning', 'If your current package is lifetime package, then you have to change / remove the current package first.');
            return back();
        }


        Session::flash('success', 'Next Package has been added successfully!');
        return back();
    }


    public function secretLogin(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if ($user) {
            Auth::guard('web')->login($user);
            return redirect()->route('user.dashboard')
                ->withSuccess('You have Successfully loggedin');
        } else {

            return redirect()->route('user.login')->withSuccess('Oppes! You have entered invalid credentials');
        }
    }


    public function userTemplate(Request $request)
    {
        if ($request->template == 1) {
            $prevImg = $request->file('preview_image');
            $allowedExts = array('jpg', 'png', 'jpeg');

            $rules = [
                'serial_number' => 'required|integer',
                'preview_image' => [
                    'required',
                    function ($attribute, $value, $fail) use ($prevImg, $allowedExts) {
                        if (!empty($prevImg)) {
                            $ext = $prevImg->getClientOriginalExtension();
                            if (!in_array($ext, $allowedExts)) {
                                return $fail("Only png, jpg, jpeg image is allowed");
                            }
                        }
                    },
                ]
            ];


            $request->validate($rules);
        }

        $user = User::where('id', $request->user_id)->first();

        if ($request->template == 1) {
            if ($request->hasFile('preview_image')) {
                @unlink(public_path('assets/front/img/template-previews/' . $user->template_img));
                $filename = uniqid() . '.' . $prevImg->getClientOriginalExtension();
                $dir = public_path('assets/front/img/template-previews/');
                @mkdir($dir, 0775, true);
                $request->file('preview_image')->move($dir, $filename);
                $user->template_img = $filename;
            }
            $user->template_serial_number = $request->serial_number;
        } else {
            @unlink(public_path('assets/front/img/template-previews/' . $user->template_img));
            $user->template_img = NULL;
            $user->template_serial_number = 0;
        }
        $user->preview_template = $request->template;
        $user->save();
        Session::flash('success', 'Status updated successfully!');
        return back();
    }

    public function userUpdateTemplate(Request $request)
    {
        $prevImg = $request->file('preview_image');
        $allowedExts = array('jpg', 'png', 'jpeg');

        $rules = [
            'serial_number' => 'required|integer',
            'preview_image' => [
                function ($attribute, $value, $fail) use ($prevImg, $allowedExts) {
                    if (!empty($prevImg)) {
                        $ext = $prevImg->getClientOriginalExtension();
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg image is allowed");
                        }
                    }
                },
            ]
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }

        $user = User::where('id', $request->user_id)->first();


        if ($request->hasFile('preview_image')) {
            @unlink(public_path('assets/front/img/template-previews/' . $user->template_img));
            $filename = uniqid() . '.' . $prevImg->getClientOriginalExtension();
            $dir = public_path('assets/front/img/template-previews/');
            @mkdir($dir, 0775, true);
            $request->file('preview_image')->move($dir, $filename);
            $user->template_img = $filename;
        }
        $user->template_serial_number = $request->serial_number;
        $user->save();


        Session::flash('success', 'Status updated successfully!');
        return "success";
    }
}
