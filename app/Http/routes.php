<?php

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

//前台首页
Route::get('/', function () {
    return view('welcome');
});

//后台首页
Route::get('/admin','Admin\IndexController@index');

//后台路由
Route::group(['prefix'=>'admin','namespace'=>'Admin'], function () {
    //菜单管理
    Route::group(['prefix'=>'admin_nav'], function () {
        Route::get('/index' ,'AdminNavController@index');
        Route::post('/store' ,'AdminNavController@store');
        Route::post('/update' ,'AdminNavController@update');
        Route::get('/destroy/{id}' ,'AdminNavController@destroy')->where('id', '[0-9]+');
        Route::post('/order' ,'AdminNavController@order');
    });

    //权限管理
    Route::group(['prefix'=>'auth_rule'] ,function () {
        //权限
        Route::get('/index' ,'AuthRuleController@index');
        Route::post('/store' ,'AuthRuleController@store');
        Route::post('/update' ,'AuthRuleController@update');
        Route::get('/destroy/{id}' ,'AuthRuleController@destroy')->where('id', '[0-9]+');
    });

    //用户组管理
    Route::group(['prefix'=>'auth_group'], function (){
        //用户组
        Route::get('/index' ,'AuthGroupController@index');
        Route::post('/store' ,'AuthGroupController@store');
        Route::post('/update' ,'AuthGroupController@update');
        Route::get('/destroy/{id}' ,'AuthGroupController@destroy')->where('id', '[0-9]+');
        //权限-用户组
        Route::get('/rule_group_show/{id}' ,'AuthGroupController@rule_group_show')->where('id', '[0-9]+');
        Route::post('/rule_group_update' ,'AuthGroupController@rule_group_update');
    });

    //用户-用户组
    Route::group(['prefix'=>'auth_group_access'], function (){
        Route::get('/search_user/{group_id}' ,'AuthGroupAccessController@search_user')->where('group_id', '[0-9]+');
        Route::get('/add_user_to_group/{uid}/{group_id}' ,'AuthGroupAccessController@add_user_to_group')->where(['uid'=>'[0-9]+', 'group_id'=>'[0-9]']);
        Route::get('/delete_user_from_group/{uid}/{group_id}' ,'AuthGroupAccessController@delete_user_from_group')->where(['uid'=>'[0-9]+', 'group_id'=>'[0-9]']);
        Route::get('/admin_user_list' ,'AuthGroupAccessController@check_user_store');
        Route::get('/add_admin' ,'AuthGroupAccessController@check_user_store');
        Route::get('/edit_admin' ,'AuthGroupAccessController@check_user_store');
    });

});


//管理员
Route::post('/admin_user_list' ,'RuleController@admin_user_list');
Route::post('/add_admin' ,'RuleController@add_admin');
Route::post('/edit_admin' ,'RuleController@edit_admin');