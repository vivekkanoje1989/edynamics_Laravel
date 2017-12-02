<?php

Route::group(array('module' => 'Invoices', 'middleware' => ['api'], 'namespace' => 'App\Modules\Invoices\Controllers'), function() {

    Route::resource('invoices', 'InvoicesController');
    
});	
