<?php

Route::group(array('module' => 'ManageCompanies', 'middleware' => ['web'], 'namespace' => 'App\Modules\ManageCompanies\Controllers'), function() {

    Route::resource('ManageCompanies', 'ManageCompaniesController');
    
});	
