<?php

Route::group(array('module' => 'TaskManagement', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\TaskManagement\Controllers'), function() {
    $getUrl = config('global.getUrl');
    

    Route::get('TaskManagement/mytasklist', 'TaskManagementController@mytasklist');
    Route::get('TaskManagement/addtask', 'TaskManagementController@addtask');
    Route::get('TaskManagement/exportToxls', 'TaskManagementController@exportToxls');
    
    Route::post('TaskManagement/createTask', 'TaskManagementController@createTask'); 

    Route::post('TaskManagement/getTasklist', 'TaskManagementController@getTasklist'); 

    Route::post('TaskManagement/getSupportEmp', 'TaskManagementController@getSupportEmp'); 
    Route::post('TaskManagement/getTmStatus', 'TaskManagementController@getTmStatus');
    Route::post('TaskManagement/getTmPriority', 'TaskManagementController@getTmPriority'); 
    
    Route::resource('TaskManagement', 'TaskManagementController');
    
});	
