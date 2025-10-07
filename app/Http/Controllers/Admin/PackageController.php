<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\PackageStoreRequest;
use App\Http\Requests\Package\PackageUpdateRequest;
use App\Models\BasicExtended;
use App\Models\Language;
use App\Models\Package;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data['packages'] = Package::query()->when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'DESC')
        ->get();
        return view('admin.packages.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     */
    public function store(Request $request)
    {
        if (!isset($request->featured)) $request["featured"] = "0";
        $features = json_encode($request->features);
        Package::create($request->except('features') + [
                'slug' => make_slug($request->title),
                'features' => $features,
        ]);
        Session::flash('success', "Package Created Successfully");
        return "success";
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
     * @return
     */
    public function edit($id)
    {
        $data['package'] = Package::query()->findOrFail($id);
        return view("admin.packages.edit", $data);
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
        if (!array_key_exists('is_trial', $request->all())) {
            $request['is_trial'] = "0";
            $request['trial_days'] = 0;
        }
        if (!in_array('Storage Limit', $request->features)) {
            $request['storage_limit'] = 999999;
        }
        if (!in_array('Table Reservation', $request->features)) {
            $request['table_reservation_limit'] = 999999;
        }
        if (!in_array('Staffs', $request->features)) {
            $request['staff_limit'] = 999999;
        }
        if (!in_array('Online Order', $request->features)) {
            $request['order_limit'] = 999999;
        }

        if (!isset($request->featured)) $request["featured"] = "0";
        $features = json_encode($request->features);
        Package::query()->findOrFail($request->package_id)
            ->update($request->except('features') + [
                    'slug' => make_slug($request->title),
                    'features' => $features,
        ]);
        Session::flash('success', "Package Update Successfully");
        return "success";
    }

    public function delete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $package = Package::query()->findOrFail($request->package_id);
                $package->delete();
                Session::flash('success', 'Package deleted successfully!');
                return back();
            });
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $ids = $request->ids;
                foreach ($ids as $id) {
                    $package = Package::query()->findOrFail($id);
                    $package->delete();
                }
                Session::flash('success', 'Package bulk deletion is successful!');
                return "success";
            });
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
