<?php

Route::group(array('module' => 'ManageClientRole', 'middleware' => ['api'], 'namespace' => 'App\Modules\ManageClientRole\Controllers'), function() {

    Route::resource('ManageClientRole', 'ManageClientRoleController');
    
});	
