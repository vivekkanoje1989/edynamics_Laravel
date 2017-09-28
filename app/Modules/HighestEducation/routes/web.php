<?php

Route::group(array('module' => 'HighestEducation','middleware' => ['auth:admin'], 'namespace' => 'App\Modules\HighestEducation\Controllers'), function() {

     $getUrl = config('global.getUrl');
    Route::get('/highest-education/exportToxls', 'HighestEducationController@exportToxls');
    Route::resource('/highest-education', 'HighestEducationController');
    Route::post('/highest-education/manageHighestEducation','HighestEducationController@manageHighestEducation');
});	

