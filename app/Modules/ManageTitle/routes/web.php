<?php

Route::group(array('module' => 'ManageTitle', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\ManageTitle\Controllers'), function() {
    $getUrl = config('global.getUrl');
    Route::get('/manageTitle/getTitle', 'ManageTitleController@getTitle');
    Route::get('/manageTitle/exportToxls','ManageTitleController@exportToxls');    
    Route::resource('/manageTitle', 'ManageTitleController');
    
});	