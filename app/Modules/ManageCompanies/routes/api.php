<?php

Route::group(array('module' => 'ManageCompanies', 'middleware' => ['api'], 'namespace' => 'App\Modules\ManageCompanies\Controllers'), function() {

    Route::resource('ManageCompanies', 'ManageCompaniesController');
    
});	
