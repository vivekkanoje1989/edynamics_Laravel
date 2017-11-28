<?php

Route::group(array('module' => 'Clients', 'middleware' => ['api'], 'namespace' => 'App\Modules\Clients\Controllers'), function() {

    Route::resource('Clients', 'ClientsController');
    Route::get('api/clients/generatecroninvoice', 'ClientsController@generatecroninvoice');
    
});	
