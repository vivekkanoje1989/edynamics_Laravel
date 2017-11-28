<?php

Route::group(array('module' => 'Clients', ['middleware' =>'auth:admin'], 'namespace' => 'App\Modules\Clients\Controllers'), function() {
    
    $getUrl = config('global.getUrl');
    Route::resource('/clientgroups', 'ClientGroupsController');
    Route::post('/clientgroups/manageClientGroup','ClientGroupsController@manageClientGroup');
    
    Route::resource('/clients', 'ClientsController');
    Route::post('/clients/manageClients','ClientsController@manageClients');
    
    Route::post('/clients/update/{id}','ClientsController@update');
    
    // changes started by balaji
    Route::get('/clients/clientinfo/{id}','ClientsController@clientinfo');
    Route::post('/clients/manageClientinfowithservices','ClientsController@manageClientinfowithservices');
    Route::post('/clients/changeServiceStatus','ClientsController@changeServiceStatus');
    
    Route::get('/clients/addservice/{id}/{sid}','ClientsController@addServiceView');
    Route::post('/clients/addmstservices','ClientsController@addmstservices');
    Route::post('/clients/createServices','ClientsController@createServices');
    Route::post('/clients/getServiceanddiscount','ClientsController@getServiceanddiscount');
    Route::post('/clients/getdiscountdetails','ClientsController@getdiscountdetails');
    Route::post('/clients/getServicefrmMaster','ClientsController@getServicefrmMaster');
    Route::post('/clients/generateInvoice','ClientsController@generateInvoice');
    Route::post('/clients/getClientfirmpartners','ClientsController@getClientfirmpartners');
    Route::post('/clients/getClientDetails','ClientsController@getClientDetails');
    
    Route::post('/clients/getinvoicedetails','ClientsController@getinvoicedetails');
    Route::post('/clients/regenerateInvoice','ClientsController@regenerateInvoice');
    
    //cloudtelephony
    
    Route::post('/clients/generateCtInvoice','ClientsController@generateCtInvoice');
    
    
});	
