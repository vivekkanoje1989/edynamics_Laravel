<?php

Route::group(array('module' => 'ManageVerticals', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\ManageVerticals\Controllers'), function() {

    $getUrl = config('global.getUrl');
    Route::get('/manageVerticals/manageVerticals','ManageVerticalsController@manageVerticals');
    Route::get('/manageVerticals/exportToxls','ManageVerticalsController@exportToxls');
    Route::resource('/manageVerticals', 'ManageVerticalsController');
    
});	
