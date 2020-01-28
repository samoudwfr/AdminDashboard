<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function registered(){
        $users = User::all();
        return view('admin.register',compact('users'));
    }

    public function register_edit(Request $request, $id){
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.register-edit',compact('user','roles'));
    }

    public function register_update(Request $request, $id){
        $users = User::findOrFail($id);
        $users->name = $request->input('username');
        $users->role_id = $request->input('usertype');
        $users->update();

        return redirect('/role-register')->with('status','Your data is updated');
    }

    public function register_delete($id){
        $users = User::findOrFail($id);
        $users->delete();

        return redirect('/role-register')->with('status','Your data is deleted');
    }

 }
