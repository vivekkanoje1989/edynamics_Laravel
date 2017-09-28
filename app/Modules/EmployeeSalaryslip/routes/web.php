<?php

Route::group(array('module' => 'EmployeeSalaryslip', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\EmployeeSalaryslip\Controllers'), function() {

    Route::post('/employeeSalaryslip/uploadzip', 'EmployeeSalaryslipController@uploadzip');
    Route::resource('/employeeSalaryslip', 'EmployeeSalaryslipController');
    
});	
