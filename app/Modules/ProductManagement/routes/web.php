<?php

Route::group(array('module' => 'ProductManagement', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\ProductManagement\Controllers'), function() {
    
    $getUrl = config('global.getUrl');

    Route::get('sub_products', 'ProductManagementController@showsub_products');
    Route::get('showmodule', 'ProductManagementController@showmodule');
    Route::get('sub_module', 'ProductManagementController@showsub_module');
    Route::post('/Product_management/getsubproducts', 'ProductManagementController@getsubproducts');    
    Route::post('/Product_management/store_sbproduct','ProductManagementController@store_sbproduct');    
    Route::put('/Product_management/update_sbproduct/{id}','ProductManagementController@update_sbproduct');    
    Route::delete('/Product_management/destroy_subproduct/{id}','ProductManagementController@destroy_subproduct'); 

    Route::post('/Product_management/getproducts','ProductManagementController@getproducts');    
    
    Route::post('/Product_management/store_pmodule','ProductManagementController@store_pmodule');    
    Route::post('/Product_management/getpmodules','ProductManagementController@getpmodules');   
    Route::post('/Product_management/update_pmodule','ProductManagementController@update_pmodule');    
    Route::delete('/Product_management/destroy_module/{id}','ProductManagementController@destroy_module');    
    
    Route::post('/Product_management/getDeveloper','ProductManagementController@getdeveloper');    
    Route::post('/Product_management/getTester','ProductManagementController@gettester');    
    

    Route::post('/Product_management/store_submodule','ProductManagementController@store_submodule');    
    Route::post('/Product_management/getsubmodules','ProductManagementController@getsubmodules');    
    Route::post('/Product_management/update_submodule','ProductManagementController@update_submodule');    
    Route::delete('/Product_management/destroy_submodule/{id}','ProductManagementController@destroy_submodule');    
    
    Route::post('/Product_management/getdeveloperById','ProductManagementController@getdeveloperById');    
    Route::post('/Product_management/gettesterById','ProductManagementController@gettesterById');    
    

    Route::resource('Product_management', 'ProductManagementController');
    
});	
