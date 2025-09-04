<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        $data['roles'] = Role::all();
        return view('admin.tenants.index', $data);
    }

    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        $data['roles'] = Role::all();
        return view('admin.tenants.edit', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|alpha_num|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->status = 1;
        $user->save();

        Session::flash('success', 'Tenant created successfully!');
        return "success";
    }

    public function update(Request $request)
    {
        // $this->validate($request, [
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'username' => 'required|alpha_num|unique:users',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:8|confirmed'
        // ]);

        $user = User::find($request->user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->status = $request->status;
        $user->save();

        Session::flash('success', 'Tenant updated successfully!');
        return "success";
    }


    public function delete(Request $request)
    {

        $user = User::find($request->user_id);
        $user->delete();
        Session::flash('success', 'Tenant deleted successfully!');
        return back();
    }


}
