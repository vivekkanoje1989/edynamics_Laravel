<?php

Route::group(array('module' => 'EmployeeSalaryslip', 'middleware' => ['api'], 'namespace' => 'App\Modules\EmployeeSalaryslip\Controllers'), function() {

    Route::resource('EmployeeSalaryslip', 'EmployeeSalaryslipController');
    
});	
