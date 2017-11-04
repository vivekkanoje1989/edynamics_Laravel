<?php

Route::group(array('module' => 'EmailConfig', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\EmailConfig\Controllers'), function() {
    $getUrl = config('global.getUrl');
    Route::post('/email-config/getdeptsel', 'EmailConfigController@getdeptsel');   
    Route::get('/email-config/getDepartments', 'EmailConfigController@getDepartments');   
    Route::post('/email-config/manageEmails', 'EmailConfigController@manageEmails');
    Route::post('/email-config/testEmail', 'EmailConfigController@testEmail');
    Route::get('/email-config/exportToxls', 'EmailConfigController@exportToxls');
    Route::resource('/email-config', 'EmailConfigController');
});
