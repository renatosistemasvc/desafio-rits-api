<?php

Route::get('webhook',['uses' => 'Api\WebhookController@store']);

Route::post('user/login-client',['uses' => 'Api\UserController@loginClient']);
Route::get('product/getAll', ['uses' => 'Api\ProductController@getAll']);
Route::post('client/store',['uses' => 'Api\ClientController@store']);

/** ROUTES USERS **/
Route::group(['prefix' => 'user', 'middleware' => ['auth:api']], function(){

    Route::get('/get-user-logged',['uses' => 'Api\UserController@getUserLogged']);
	Route::post('/store',['uses' => 'Api\UserController@store']);
});

/** ROUTES CLIENTS **/
Route::group(['prefix' => 'client', 'middleware' => ['auth:api']], function(){

	Route::post('/getAllPaginate/{filtro?}', ['uses' => 'Api\ClientController@getAllPaginate']);
	Route::post('/getAll', ['uses' => 'Api\ClientController@getAll']);
	Route::get('/getById/{id}', ['uses' => 'Api\ClientController@getById']);
	Route::post('/update/{id}',['uses' => 'Api\ClientController@update']);
	Route::delete('/delete/{id}', ['uses' => 'Api\ClientController@delete']);
});

/** ROUTES PRODUCTS **/
Route::group(['prefix' => 'product', 'middleware' => ['auth:api']], function(){

	Route::post('/getAllPaginate/{filtro?}', ['uses' => 'Api\ProductController@getAllPaginate']);
	Route::get('/getById/{id}', ['uses' => 'Api\ProductController@getById']);
	Route::post('/store',['uses' => 'Api\ProductController@store']);
	Route::post('/update/{id}',['uses' => 'Api\ProductController@update']);
	Route::delete('/delete/{id}', ['uses' => 'Api\ProductController@delete']);
});

/** ROUTES SALES **/
Route::group(['prefix' => 'sale', 'middleware' => ['auth:api']], function(){

	Route::post('/getAllPaginate/{qtd?}', ['uses' => 'Api\SaleController@getAllPaginate']);
	Route::get('/cancelSale/{id}', ['uses' => 'Api\SaleController@cancelSale']);
	Route::get('/getById/{id}', ['uses' => 'Api\SaleController@getById']);
	Route::post('/store',['uses' => 'Api\SaleController@store']);
	Route::post('/updateStatus',['uses' => 'Api\SaleController@updateStatus']);
	Route::delete('/delete/{id}', ['uses' => 'Api\SaleController@delete']);
});
