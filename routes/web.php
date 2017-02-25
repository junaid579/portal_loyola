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

Route::get('/', 'welcomeController@index');
Route::post('/login', 'userController@login');
Route::get('/dashboard', 'userController@dashboard');
Route::get('/logout', 'welcomeController@logout');

Route::get('/classes', 'classesController@index');
Route::post('/classes', 'classesController@findAction');
Route::put('/classes', 'classesController@update');
Route::get('/classes/{id}/{status}', 'classesController@statusupdate');


Route::get('/sections', 'sectionsController@index');
Route::post('/sections', 'sectionsController@findAction');
Route::put('/sections', 'sectionsController@update');
Route::get('/sections/{id}/{status}', 'sectionsController@statusupdate');


Route::get('/occupation', 'occupationController@index');
Route::post('/occupation', 'occupationController@findAction');
Route::put('/occupation', 'occupationController@update');
Route::get('/occupation/{id}/{status}', 'occupationController@statusupdate');


Route::get('/feeTypes', 'feeTypesController@index');
Route::post('/feeTypes', 'feeTypesController@findAction');
Route::put('/feeTypes', 'feeTypesController@update');
Route::get('/feeTypes/{id}/{status}', 'feeTypesController@statusupdate');



Route::get('/transportPickup', 'transportPickupController@index');
Route::post('/transportPickup', 'transportPickupController@insert');
Route::put('/transportPickup', 'transportPickupController@update');
Route::get('/transportPickup/{id}/{status}', 'transportPickupController@statusupdate');


Route::get('/staff', 'staffController@index');
Route::post('/staff', 'staffController@findAction');
Route::put('/staff', 'staffController@update');
Route::get('/staff/{id}/{status}', 'staffController@statusupdate');



Route::get('/caste', 'casteController@index');
Route::post('/caste', 'casteController@findAction');
Route::put('/caste', 'casteController@update');
Route::get('/caste/{id}/{status}', 'casteController@statusupdate');

/* Route::post('login', function () {
    echo $_POST['username'];
}); */
Route::get('/dashboard', 'dashboardController@dashboard');


Route::resource('/test' ,'testController@index');
Route::post('/test' ,'testController@findAction');


