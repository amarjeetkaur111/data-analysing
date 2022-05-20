<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administration;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Category;
use App\Http\Controllers\Fields;
use App\Http\Controllers\Dataentry;
use App\Http\Controllers\Reports;
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

Route::get('/', function(){return view('Login');})->name('login');
Route::post('/CheckLogin',[Administration::class,'Login'])->name('AdminLogin');
Route::get('/logout', [Administration::class,'Logout'])->name('logout');

Route::group(['middleware'=>'checkuser'],function(){
	Route::get('/dashboard',[Administration::class,'dashboard'])->name('dashboard');
	
	Route::get('/administration/users',[Administration::class,'Users'])->name('users');
    Route::post('/administration/users/add_user',[Administration::class,'AddUser'])->name('AddUser');
    Route::get('/administration/users/edit_user/{id}',[Administration::class,'EditUser']);
    Route::post('/administration/users/update_user',[Administration::class,'UpdateUser'])->name('UpdateUser');
    Route::get('/administration/users/delete_user/{id}',[Administration::class,'DeleteUser']);	
	
    Route::post('/administration/pharmacies/add_pharmacy',[Administration::class,'AddPharmacy'])->name('AddPharmacy');
    Route::get('/administration/pharmacies/edit_pharmacy/{id}',[Administration::class,'EditPharmacy']);
    Route::post('/administration/pharmacies/update_pharmacy',[Administration::class,'UpdatePharmacy'])->name('UpdatePharmacy');
    Route::get('/administration/pharmacies/delete_pharmacy/{id}',[Administration::class,'DeletePharmacy']);	
	
	Route::get('/category',[Category::class,'Categories'])->name('categories');	
	Route::post('/category/insert_new',[Category::class,'AddCategory'])->name('AddCategory');
	Route::get('/category/delete_category/{id}',[Category::class,'DeleteCategory']);	
	Route::get('/category/edit_category/{id}',[Category::class,'EditCategory']);
	Route::post('/category/update_category',[Category::class,'UpdateCategory'])->name('UpdateCategory');	

	Route::post('/category/add_field',[Fields::class,'InsertField'])->name('InsertFields');	
	Route::get('category/fields',[Fields::class,'FieldsList'])->name('FieldsList');
	Route::get('/fields/fetch_fields/{id}',[Fields::class,'FetchFieldsCategoryWise']);
	Route::get('/fields/edit_field/{id}',[Fields::class,'EditField']);
	Route::post('/fields/update_field',[Fields::class,'UpdateField'])->name('UpdateField');
	Route::get('/fields/delete_field/{id}',[Fields::class,'DeleteField']);
	
	Route::get('/dataentry',[Dataentry::class,'DataentryForm'])->name('DataentryForm');	
	Route::post('/dataentry_form',[Dataentry::class,'DataEntryFormView'])->name('DataEntryFormView');
	Route::post('/dataentry/submit',[Dataentry::class,'SubmitDataEntry'])->name('SubmitDataEntry');

	Route::get('/reports',[Reports::class,'DataEntryReports'])->name('DataEntryReports'); 
	Route::post('/reports',[Reports::class,'DataEntryReport'])->name('DataEntryReport');
	
});