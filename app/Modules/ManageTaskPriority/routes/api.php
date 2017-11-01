<?php

Route::group(array('module' => 'ManageTaskPriority', 'middleware' => ['api'], 'namespace' => 'App\Modules\ManageTaskPriority\Controllers'), function() {

    Route::resource('ManageTaskPriority', 'ManageTaskPriorityController');
    
});	
