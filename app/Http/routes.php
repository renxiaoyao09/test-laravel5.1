<?php
use App\User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// 认证路由...
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');
// 注册路由...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('/auth/register', 'Auth\AuthController@postRegister');


Route::get('/aaa', function () {
    echo '123';
});    
Route::get('/bbb','UserController@bbb');




// Route::group([],function(){
//     Route::post('/user/create','UserController@create');
//     Route::get('/user/show','UserController@show');
//     Route::get('/user/details/{id}','UserController@details');
//     Route::post('/user/update/{id}','UserController@update');
//     Route::get('/user/bbb/{id}','UserController@bbb');
// });

// Route::group([],function(){
//     Route::get('/userinfo/show/{id}','UserinfoController@show');
// });

// Route::group([],function(){
//     Route::post('/user/create','UserController@create');
//     Route::get('/user/show','UserController@show');
//     Route::get('/user/edit','UserController@edit');
// });

Route::get('profile','UserController@profile');

Route::group([],function(){
    // 注册
    Route::post('/user/insert','UserController@insert');
    // 登录
    Route::post('/user/login','UserController@login');
    // 上传头像
    Route::post('/user/postFileupload','UserController@postFileupload');
    // 用户列表
    Route::get('/user/userList','UserController@userList');
});