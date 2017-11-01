<?php

Route::group(array('module' => 'ManageTaskPriority', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\ManageTaskPriority\Controllers'), function() {
    $getUrl = config('global.getUrl');
    Route::get('ManageTaskPriority/exportToxls', 'ManageTaskPriorityController@exportToxls');
    Route::post('ManageTaskPriority/getPriority', 'ManageTaskPriorityController@getPriority');
    Route::resource('ManageTaskPriority', 'ManageTaskPriorityController');
    
});	
