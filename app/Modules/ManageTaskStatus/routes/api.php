<?php

Route::group(array('module' => 'ManageTaskStatus', 'middleware' => ['api'], 'namespace' => 'App\Modules\ManageTaskStatus\Controllers'), function() {

    Route::resource('ManageTaskStatus', 'ManageTaskStatusController');
    
});	
