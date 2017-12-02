<?php

Route::group(array('module' => 'Invoices', 'middleware' => ['web'], 'namespace' => 'App\Modules\Invoices\Controllers'), function() {

    Route::resource('invoices', 'InvoicesController');
    Route::get('/invoices/index/{id}','InvoicesController@index');
    Route::post('/invoices/manageClientInvoices','InvoicesController@manageClientInvoices');
    Route::post('/invoices/regenerateInvoice','InvoicesController@regenerateInvoice');
    
});	
