<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'User@SelectQP');
Route::get('/QB/{path}',function(){
	$file = Storage::get($path);
   dd($path);
   return Response::make($file, 200, [
	    'Content-Type' => 'application/pdf',
	    'Content-Disposition' => 'inline; filename="'.$path.'"'
	]);

})->name('QB');
Route::post('/',['as' => 'User','uses'=>'User@qb']);
Route::get('upload', 
	['as' => 'upload', 'uses' =>'User@Upload']);
Route::post('upload', 
	['as' => 'upload_store', 'uses' => 'User@storeQP']);



Route::group(['middleware' => 'guest_auth'],function(){
Route::get('admin/login',
	['as' => 'loginform', 'uses' => 'Admin_Auth@showLogin']);
Route::post('admin/login',
	['as' => 'login', 'uses' => 'Admin_Auth@login']);
});
Route::group(['middleware' => 'admin_auth'],function(){
/*Route::get('admin/register',
	['as' => 'form', 'uses' => 'AdminReg@showform']);
Route::post('admin/register',
	['as' => 'register', 'uses' =>'AdminReg@register']);
	*/
Route::post('admin/logout',
	['as' => 'logout', 'uses' => 'Admin_Auth@logout']);
	
Route::get('admin/register',
	['as' => 'form', 'uses' => 'AdminReg@showform']);
Route::post('admin/register',
	['as' => 'register', 'uses' =>'AdminReg@register']);
Route::post('admin/remove',['as' => 'remove','uses'=>'AdminReg@remove']);
Route::get('admin/QB',['as' => 'MngQB','uses'=>'AdminDash@SelectQP']);
Route::post('admin/QB',['as' => 'showQB','uses'=>'AdminDash@QB']);
Route::get('admin/QB/{qid}',['as' => 'delQB','uses'=>'AdminDash@delQB']);
Route::get('admin',['as' => 'queue','uses' => 'AdminDash@showQueue']);
Route::get('admin/changepass',['as' => 'changepass','uses' => 'AdminReg@showpass']);
Route::post('admin/changepass',['as' => 'change','uses' => 'AdminReg@change']);

Route::get('admin/queue/view/{qid}',['as' => 'queueLink','uses' => 'AdminDash@getFile']);
Route::get('admin/queue/approve/{qid}',['as' => 'queueApr','uses' => 'AdminDash@queueApr']);
Route::get('admin/queue/delete/{qid}',['as' => 'queueDel','uses' => 'AdminDash@queueDel']);
Route::get('admin/MngProg',['as'=> 'MngProg','uses' => 'AdminDash@MngProg']);
Route::post('admin/MngProg/add',['as'=> 'addProg','uses' => 'AdminDash@addProg']);
Route::post('admin/MngDep/del',['as'=> 'delProg','uses' => 'AdminDash@delProg']);
Route::get('admin/MngDep',['as'=> 'MngDep','uses' => 'AdminDash@MngDep']);
Route::post('admin/MngDep/add',['as'=> 'addDep','uses' => 'AdminDash@addDep']);
Route::post('admin/MngDep',['as'=> 'delDep','uses' => 'AdminDash@delDep']);

Route::get('admin/MngCrs',['as'=> 'MngCrs','uses' => 'AdminDash@MngCrs']);
Route::post('admin/MngCrs/add',['as'=> 'addCrs','uses' => 'AdminDash@addCrs']);
Route::post('admin/MngCrs/del',['as'=> 'delCrs','uses' => 'AdminDash@delCrs']);
});

