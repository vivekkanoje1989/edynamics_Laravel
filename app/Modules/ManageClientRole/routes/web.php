<?php

Route::group(array('module' => 'ManageClientRole', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\ManageClientRole\Controllers'), function() {
    $getUrl = config('global.getUrl');
    Route::get('/manageClientRole/getClientRole', 'ManageClientRoleController@getClientRole');
    Route::get('/manageClientRole/exportToxls', 'ManageClientRoleController@exportToxls');
    Route::resource('/manageClientRole', 'ManageClientRoleController');
    
});	