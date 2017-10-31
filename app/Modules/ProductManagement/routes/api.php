<?php

Route::group(array('module' => 'ProductManagement', 'middleware' => ['api'], 'namespace' => 'App\Modules\ProductManagement\Controllers'), function() {

    Route::resource('Product_management', 'ProductManagementController');
    
});	
