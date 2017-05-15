<?php

Route::group(array('module' => 'Products', 'middleware' => ['web'], 'namespace' => 'App\Modules\Products\Controllers'), function() {
    
    $getUrl = config('global.getUrl');
    Route::resource($getUrl.'/products', 'ProductsController');
    Route::post($getUrl . '/products/manageProducts','ProductsController@manageProducts');
    
    Route::resource($getUrl.'/subproducts', 'SubproductsController');
    Route::post($getUrl . '/subproducts/manageSubProducts','SubproductsController@manageSubProducts');
    
    
});	
