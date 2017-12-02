<?php

Route::group(array('module' => 'Invoices', ['middleware' =>'auth:admin'], 'namespace' => 'App\Modules\Invoices\Controllers'), function() {

    Route::get('/invoices/index/{id}','InvoicesController@index');
    Route::resource('invoices', 'InvoicesController');
    
    Route::post('/invoices/manageClientInvoices','InvoicesController@manageClientInvoices');
    Route::post('/invoices/regenerateInvoice','InvoicesController@regenerateInvoice');
    
});	
