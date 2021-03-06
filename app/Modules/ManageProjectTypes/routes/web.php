<?php

Route::group(array('module' => 'ManageProjectTypes','middleware' => ['auth:admin'], 'namespace' => 'App\Modules\ManageProjectTypes\Controllers'), function() {

    $getUrl = config('global.getUrl');
    Route::get('/project-types/exportToxls', 'ManageProjectTypesController@exportToxls');
    Route::resource('/project-types', 'ManageProjectTypesController');
    Route::post('/project-types/manageProjectTypes','ManageProjectTypesController@manageProjectTypes');
});	

