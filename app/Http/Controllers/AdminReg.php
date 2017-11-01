<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class AdminReg extends Controller
{
    public function showRegistrationForm()
    {
        return view('seller.auth.register');
    }

  //Handles registration request for seller
    public function showform()
    {
    	return view('Admin.register');
    }
    public function register(Request $request)
    {

       //Validates data
        $validated= $request->validate([
        	'name' => 'required',
        	'username' => 'required|unique:ADMINS,Username',
        	'password' => 'required|min:6|confirmed',
        ]);

       //Create seller
        $admin=new Admin;
        $admin->Name=$request->name;
        $admin->Username=$request->username;
        $admin->Password=bcrypt($request->password);
        $admin->save();       //Authenticates seller

       //Redirects sellers
        return back()->with('message','Admin Registered');
    }
}
