<?php

Route::group(array('module' => 'ManageCompanyTypes', 'middleware' => ['api'], 'namespace' => 'App\Modules\ManageCompanyTypes\Controllers'), function() {

    Route::resource('ManageCompanyTypes', 'ManageCompanyTypesController');
    
});	
