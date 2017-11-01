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
Route::get('admin/register',
	['as' => 'form', 'uses' => 'AdminReg@showform']);
Route::post('admin/register',
	['as' => 'register', 'uses' =>'AdminReg@register']);
Route::get('admin',['as' => 'queue','uses' => 'AdminDash@showQueue']);
Route::get('admin/queue/view/{qid}',['as' => 'queueLink','uses' => 'AdminDash@getFile']);
Route::get('admin/queue/approve/{qid}',['as' => 'queueApr','uses' => 'AdminDash@queueApr']);
Route::get('admin/queue/delete/{qid}',['as' => 'queueDel','uses' => 'AdminDash@queueDel']);
});

