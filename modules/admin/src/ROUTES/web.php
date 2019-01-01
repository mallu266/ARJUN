<?php

$namespace = "ARJUN\ADMIN\CONTROLLERS";

Route::group(['middleware' => ['web'], 'namespace' => $namespace], function () {
    Route::get('login/lock', 'AUTH\LOGINCONTROLLER@screenlock');
    Route::post('login/unlock', 'AUTH\LOGINCONTROLLER@screenunlock');
});

Route::group(['prefix' => 'password', 'middleware' => ['web', 'logger:admin'], 'namespace' => $namespace], function () {
    Route::get('setpassword/{email}/{token}', 'USERSCONTROLLER@setpassword');
    Route::post('setpassword', 'USERSCONTROLLER@PostSetPassword');
});
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'logger:admin'], 'namespace' => $namespace], function () {
    Route::get('/', 'ADMINCONTROLLER@login');
    Route::get('login', 'AUTH\LOGINCONTROLLER@showLoginForm');
    Route::post('login', 'AUTH\LOGINCONTROLLER@login');
});
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth:admin', 'logger:admin'], 'namespace' => $namespace], function () {
    Route::get('dashboard', 'ADMINCONTROLLER@showDasbboard');
    Route::get('logout', 'ADMINCONTROLLER@logout');
});
Route::group(['prefix' => 'admin/acl', 'middleware' => ['web', 'auth:admin', 'logger:admin'], 'namespace' => $namespace . '\ACL'], function () {
    Route::get('/', 'ACLCONTROLLER@index');
//    Roles Controlles
    Route::get('roles/{id?}', 'ROLESCONTROLLER@index');
    Route::post('role/post', 'ROLESCONTROLLER@create');

//    Permissions Controlles
    Route::get('permissions/{id?}', 'PERMISSIONCONTROLLER@index');
    Route::post('permission/post', 'PERMISSIONCONTROLLER@create');

//    Role Permissions Controlles
    Route::get('rolematrix', 'ACLCONTROLLER@rolematrix');
    Route::get('permissionmatrix', 'ACLCONTROLLER@permissionmatrix');
    Route::get('usermatrix', 'ACLCONTROLLER@usermatrix');
    Route::post('rolematrix/post', 'ACLCONTROLLER@postrolematrix');
});
Route::group(['prefix' => 'admin/settings', 'middleware' => ['web', 'auth:admin', 'logger:admin'], 'namespace' => $namespace . '\SETTINGS'], function () {
    Route::get('/', 'SETTINGSCONTROLLER@index');
});
Route::group(['prefix' => 'admin/users', 'middleware' => ['web', 'auth:admin', 'logger:admin'], 'namespace' => $namespace], function () {
    Route::get('/', 'USERSCONTROLLER@index');
    Route::get('add', 'USERSCONTROLLER@action');
    Route::get('show/{id}', 'USERSCONTROLLER@action');
    Route::get('edit/{id}', 'USERSCONTROLLER@action');
    Route::get('delete', 'USERSCONTROLLER@action');
    Route::post('action/{id?}', 'USERSCONTROLLER@addupdate');
    Route::get('notify', 'USERSCONTROLLER@testnotification');
});
Route::group(['prefix' => 'admin/logs', 'middleware' => ['web', 'auth:admin', 'logger:admin'], 'namespace' => $namespace], function () {
    Route::get('/', 'LOGSCONTROLLER@index');
    //    Users
    Route::get('users/', 'LOGS\USERLOGSCONTROLLER@index');
    Route::get('users/log/{id}', 'LOGS\USERLOGSCONTROLLER@viewlog');

//    Queues
    Route::get('queues/', 'LOGS\QUEUELOGSCONTROLLER@index');

//    Errorlogs
    Route::get('errorlogs/', 'LOGS\ERRORLOGCONTROLLER@index');
//    DATATABLES
    Route::get('users/datatable', 'LOGS\USERLOGSCONTROLLER@getDatatable');
    Route::get('queues/datatable', 'LOGS\QUEUELOGSCONTROLLER@getDatatable');
});
