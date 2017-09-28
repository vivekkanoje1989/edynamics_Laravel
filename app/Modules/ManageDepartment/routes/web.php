<?php

Route::group(array('module' => 'ManageDepartment','middleware' => ['auth:admin'],'namespace' => 'App\Modules\ManageDepartment\Controllers'), function() {
    
     $getUrl = config('global.getUrl');
     Route::get('/manage-department/exportToxls', 'ManageDepartmentController@exportToxls');
     Route::resource('/manage-department', 'ManageDepartmentController');
     Route::post('/manage-department/manageDepartment','ManageDepartmentController@manageDepartment');   
     Route::post('/manage-department/getDepartment','ManageDepartmentController@getDepartment');   
});	


