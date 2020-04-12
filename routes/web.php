<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.show.admin');
Route::get('/login/blogger', 'Auth\LoginController@showBloggerLoginForm')->name('login.show.blogger');
Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('login.post.admin');
Route::post('/login/blogger', 'Auth\LoginController@bloggerLogin')->name('login.post.blogger');

Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('register.show.admin');
Route::get('/register/blogger', 'Auth\RegisterController@showBloggerRegisterForm')->name('register.show.blogger');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register.post.admin');
Route::post('/register/blogger', 'Auth\RegisterController@createBlogger')->name('register.post.blogger');

Route::view('/home', 'home')->name('home')->middleware('auth');
Route::view('/admin', 'admin')->name('admin')->middleware('auth:admin');
Route::view('/blogger', 'blogger')->name('blogger')->middleware('auth:blogger');
