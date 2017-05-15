<?php

Route::group(array('module' => 'Products', 'middleware' => ['api'], 'namespace' => 'App\Modules\Products\Controllers'), function() {

    Route::resource('products', 'ProductsController');
    
});	
