<?php

Route::group(array('module' => 'ManageGender', 'middleware' => ['api'], 'namespace' => 'App\Modules\ManageGender\Controllers'), function() {

    Route::resource('ManageGender', 'ManageGenderController');
    
});	
