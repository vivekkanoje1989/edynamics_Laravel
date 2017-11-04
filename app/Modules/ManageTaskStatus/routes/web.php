<?php

Route::group(array('module' => 'ManageTaskStatus', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\ManageTaskStatus\Controllers'), function() {

    $getUrl = config('global.getUrl');
    Route::get('ManageTaskStatus/exportToxls', 'ManageTaskStatusController@exportToxls');
    Route::post('ManageTaskStatus/getStatus', 'ManageTaskStatusController@getStatus');
    Route::resource('ManageTaskStatus', 'ManageTaskStatusController');
    
});	
