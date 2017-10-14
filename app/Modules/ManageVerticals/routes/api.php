<?php

Route::group(array('module' => 'ManageVerticals', 'middleware' => ['api'], 'namespace' => 'App\Modules\ManageVerticals\Controllers'), function() {

    Route::resource('ManageVerticals', 'ManageVerticalsController');
    
});	
