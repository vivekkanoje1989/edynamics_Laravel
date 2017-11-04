<?php

Route::group(array('module' => 'TaskManagement', 'middleware' => ['api'], 'namespace' => 'App\Modules\TaskManagement\Controllers'), function() {

    Route::resource('TaskManagement', 'TaskManagementController');
    
});	
