<?php

Route::group(array('module' => 'ManageGender', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\ManageGender\Controllers'), function() {
    
    $getUrl = config('global.getUrl');
    Route::get('/manageGender/getGender', 'ManageGenderController@getGender');
    Route::get('/manageGender/exportToxls', 'ManageGenderController@exportToxls');
    Route::resource('/manageGender', 'ManageGenderController');
    
});	
