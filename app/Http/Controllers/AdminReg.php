<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Auth;
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
    	$user=Auth::guard('web_admins')->user()->username;
    	$admins=Admin::where('username','!=',$user)->get();
    	return view('Admin.register')->with('admins',$admins);
    }
    public function showpass()
    {
    	return view('Admin.chngpass');
    }
    public function change(Request $request)
    {
    	        $validated= $request->validate([
                	'password' => 'required|min:6|confirmed',
        ]);
    	        $user=Auth::guard('web_admins')->user()->username;
    	        Admin::where('username',$user)->update(['password'=>bcrypt($request->password)]);

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
            	$user=Auth::guard('web_admins')->user()->username;
    	$admins=Admin::where('username','!=',$user)->get();
       //Redirects sellers
    	$data=array('message' => 'Admin Registered',
    	$admins );
        return back()->with($data);
    }
    public function remove(Request $request)
    {

    	Admin::where('username',$request->username)->delete();
    	return \Redirect::back();
    }
}
