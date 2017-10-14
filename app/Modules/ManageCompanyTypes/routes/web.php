<?php

Route::group(array('module' => 'ManageCompanyTypes', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\ManageCompanyTypes\Controllers'), function() {

    Route::get('/manageCompanyTypes/getCompanyTypes', 'ManageCompanyTypesController@getCompanyTypes');
    Route::get('/manageCompanyTypes/exportToxls', 'ManageCompanyTypesController@exportToxls');
    Route::resource('/manageCompanyTypes', 'ManageCompanyTypesController');
    
});	
