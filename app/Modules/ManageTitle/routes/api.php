<?php

Route::group(array('module' => 'ManageTitle', 'middleware' => ['api'], 'namespace' => 'App\Modules\ManageTitle\Controllers'), function() {

    Route::resource('ManageTitle', 'ManageTitleController');
    
});	
