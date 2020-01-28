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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin']], function (){

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/role-register', 'Admin\DashboardController@registered')->name('role-register');
    Route::get('/role-edit/{id}','Admin\DashboardController@register_edit');
    Route::put('/role-register-update/{id}','Admin\DashboardController@register_update');
    Route::delete('/role-delete/{id}','Admin\DashboardController@register_delete');

    Route::get('/testRoles', 'Test\TestRoleController@index')->name('testRoles');
    Route::get('/crudVueJs', 'Test\CrudVueJsController@index')->name('crudVueJs');

    Route::post('saveStudent','Test\CrudVueJsController@saveStudent');
    Route::get('allStudents','Test\CrudVueJsController@allStudents');
    Route::get('editStudent/{id}','Test\CrudVueJsController@editStudent');
    Route::put('updateStudent','Test\CrudVueJsController@updateStudent');
    Route::delete('deleteStudent/{id}','Test\CrudVueJsController@deleteStudent');
});
