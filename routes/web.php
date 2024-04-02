<?php

use App\Models\Order_detail;
use App\Models\Table;
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

//view menu
Route::get('/', 'MenuController@index');

//view menu sama no meja
Route::get('/table/{id}','TableController@create');

// get data berdasarkan menu id
Route::get('/menu/{id}', 'Order_detailController@detail');

//Post data ke table order_detail
Route::post('/menudetail','Order_detailController@store');

//view order
Route::get('/order','Order_detailController@showorder');

//Update data note dan quantity pada table order details
Route::post('/order/{id}','Order_detailController@update');

// view order dihalaman checkout
Route::get('/checkout','OrderController@index');

//delete order
Route::delete('/order/{id}','Order_detailController@delete');

//update data nama, room number, payment_status pada table order
Route::post('/checkout/{id}','OrderController@updateCustomer');

Route::post('/checkout','TableController@inputDataTable');

// Route::get('/checkout','TableController@showTable');

//search menu berdasarkan nama menu
Route::get('/menu/search','MenuController@search');