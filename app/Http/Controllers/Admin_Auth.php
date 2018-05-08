<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class Admin_Auth extends Controller
{
    //

    use AuthenticatesUsers;
    protected $redirectPath = 'admin';
    protected $username='username';
    	protected function guard()
	{
		return Auth::guard('web_admins');
	}    

	public function showLogin()
	{
		return view('Admin.login');
	}

}
