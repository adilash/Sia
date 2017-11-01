<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class AdminAuth extends Controller
{
    //
    use AuthenticatesUsers;
    
	protected function guard()
	{
		return Auth::guard('web_admins');
	}    

	public function showLogin()
	{
		return view('Admin.login');
	}

}
