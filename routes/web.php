<?php

use Illuminate\Support\Facades\Route;

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
    return view('user.welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['admin']],function(){
    Route::get('/admin', 'Admin\AdminController@index')->name('admin');
    Route::get('/admin-profile', 'Admin\AdminController@Profile');
    Route::post('/admin-edit', 'Admin\AdminController@ProfileEdit');

    Route::get('/view-sellers', 'Admin\ViewsellerController@index');
    Route::get('/change-padding-status', 'Admin\ViewsellerController@ChangeStatus');

    Route::match(['get','post'],'/add-catagory', 'Admin\CatagoriesController@VCatagory');
    Route::post('/add-cata-pro', 'Admin\CatagoriesController@AddCatagory');
    Route::get('/getsectionforcata', 'Admin\CatagoriesController@Getsectionforcata');
    Route::get('/delete-catagory', 'Admin\CatagoriesController@DeleteCatagory');
    Route::get('/admin-change-status-catagory', 'Admin\CatagoriesController@AdminChangeCatagoryStatus');
    Route::get('/admineditcatagory/{id}', 'Admin\CatagoriesController@EditCatagory');
    Route::post('/update-edit-catagory', 'Admin\CatagoriesController@UpdateEditCatagory');

    Route::match(['get','post'],'/add-product', 'Admin\ProductController@index');
    Route::get('/delete-product', 'Admin\ProductController@Delete');
    
    Route::get('/sections', 'Admin\SectionController@index');
    Route::get('/adminsectionstatus', 'Admin\SectionController@AdminSectionStatus');
});
// Route::get('/admin', 'Admin\AdminController@index')->name('admin')->middleware('admin');
// Route::get('/admin-profile', 'Admin\AdminController@Profile')->middleware('admin');


Route::get('/manager', 'Manager\ManagerController@index')->name('Manager')->middleware('manager');
Route::get('/user', 'User\UserController@index')->name('user')->middleware('user');
// Route::post('/profilechanges','User\UserController@ProfileChanges');
