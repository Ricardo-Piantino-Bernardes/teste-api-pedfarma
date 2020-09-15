<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'api', 'as' => 'api.'], function (){
    Route::apiResource('/fornecedor', 'ProviderController');

    Route::get('/produto/ativos', 'ProductController@ActiveProducts');
    Route::get('/produto/inativos', 'ProductController@InactiveProducts');
    Route::apiResource('/produto', 'ProductController');

    Route::apiResource('/venda', 'SaleController');
    Route::apiResource('/cliente', 'ClientController');
});



