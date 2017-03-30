<?php

Route::group(array('module' => 'Clients', 'namespace' => 'App\Modules\Clients\Controllers'), function() {
    
    $getUrl = config('global.getUrl');
    Route::resource($getUrl.'/clientgroups', 'ClientGroupsController');
    Route::post($getUrl . '/clientgroups/manageClientGroup','ClientGroupsController@manageClientGroup');
    
});	
