<?php

Route::group(array('module' => 'ManageProfession', 'middleware' => ['auth:admin'],'namespace' => 'App\Modules\ManageProfession\Controllers'), function() {

    $getUrl = config('global.getUrl');
    Route::get('/manage-profession/exportToxls', 'ManageProfessionController@exportToxls');
    Route::resource('/manage-profession', 'ManageProfessionController');
     Route::post('/manage-profession/manageProfession','ManageProfessionController@manageProfession');
    
});	
