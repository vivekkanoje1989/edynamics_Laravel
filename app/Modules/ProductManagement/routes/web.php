<?php

Route::group(array('module' => 'ProductManagement', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\ProductManagement\Controllers'), function() {
    
    $getUrl = config('global.getUrl');

    Route::get('sub_products', 'ProductManagementController@showsub_products');
    Route::get('showmodule', 'ProductManagementController@showmodule');
    Route::get('sub_module', 'ProductManagementController@showsub_module');
    Route::post('/Product_management/getproducts','ProductManagementController@getproducts');    
    Route::resource('Product_management', 'ProductManagementController');
    
});	
