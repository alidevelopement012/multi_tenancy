<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Helpers\MegaMailer;
use App\Models\Language;
use App\Models\Membership;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PaymentLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $username = $request->username;
        $data['memberships'] = Membership::query()->when($search, function ($query, $search) {
            return $query->where('transaction_id', 'like', '%' . $search . '%');
        })->whereHas('user', function (Builder $query) use ($username) {
            $query->when($username, function ($query, $username) {
                return $query->where('username', 'like', '%' . $username . '%');
            });
        })
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('admin.payment_log.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function transaction(Request $request)
    {
        $search = $request->search;
        $data['memberships'] = Membership::query()
            ->where('admin_id', Auth::guard('web')->user()->id)
            ->when($search, function ($query, $search) {
                return $query->where('transaction_id', $search);
            })
            ->orderBy('expire_date', 'DESC')
            ->paginate(10);
        return view('admin.transaction.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     */
    public function update(Request $request)
    {

        $membership = Membership::query()->findOrFail($request->id);
        $user = User::query()->findOrFail($membership->user_id);
        $package = Package::query()->findOrFail($membership->package_id);

        $member['first_name'] = $user->first_name;
        $member['last_name'] = $user->last_name;
        $member['username'] = $user->username;
        $member['email'] = $user->email;
        $data['payment_method'] = $membership->payment_method;

        //comparison date
        $date1 = Carbon::createFromFormat('m/d/Y', \Carbon\Carbon::parse($membership->start_date)->format('m/d/Y'));
        $date2 = Carbon::createFromFormat('m/d/Y', \Carbon\Carbon::now()->format('m/d/Y'));
        $result = $date1->gte($date2);
        if ($result) {
            $data['start_date'] = $membership->start_date;
            $data['expire_date'] = $membership->expire_date;
        } else {
            $data['start_date'] = Carbon::today()->format('d-m-Y');
            if ($package->term === "daily") {
                $data['expire_date'] = Carbon::today()->addDay()->format('d-m-Y');
            } elseif ($package->term === "weekly") {
                $data['expire_date'] = Carbon::today()->addWeek()->format('d-m-Y');
            } elseif ($package->term === "monthly") {
                $data['expire_date'] = Carbon::today()->addMonth()->format('d-m-Y');
            } elseif ($package->term === "lifetime") {
                $data['expire_date'] = Carbon::maxValue()->format('d-m-Y');
            } else {
                $data['expire_date'] = Carbon::today()->addYear()->format('d-m-Y');
            }
            $membership->update(['start_date' =>  Carbon::parse($data['start_date'])]);
            $membership->update(['expire_date' =>  Carbon::parse($data['expire_date'])]);
        }

        // if previous membership package is lifetime, then exipre that membership
        $previousMembership = Membership::query()
            ->where([
                ['user_id', $user->id],
                ['start_date', '<=', Carbon::now()->toDateString()],
                ['expire_date', '>=', Carbon::now()->toDateString()]
            ])
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->first();
        if (!is_null($previousMembership)) {
            $previousPackage = Package::query()
                ->select('term')
                ->where('id', $previousMembership->package_id)
                ->first();
            if ($previousPackage->term === 'lifetime' || $previousMembership->is_trial == 1) {
                $yesterday = Carbon::yesterday()->format('d-m-Y');
                $previousMembership->expire_date = Carbon::parse($yesterday);
                $previousMembership->save();
            }
        }
        $membership->update(['status' => $request->status]);

        session()->flash('success', "Membership status changed successfully!");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
