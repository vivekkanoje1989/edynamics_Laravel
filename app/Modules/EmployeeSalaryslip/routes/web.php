<?php

Route::group(array('module' => 'EmployeeSalaryslip', 'middleware' => ['auth:admin'], 'namespace' => 'App\Modules\EmployeeSalaryslip\Controllers'), function() {

    Route::get('/employeeSalaryslip/getMySalaryslips', 'EmployeeSalaryslipController@getMySalaryslips');
    Route::post('/employeeSalaryslip/downloadSalaryslipsZip', 'EmployeeSalaryslipController@downloadSalaryslipsZip');
    Route::get('/employeeSalaryslip/mysalaryslip', 'EmployeeSalaryslipController@mysalaryslip');
    Route::post('/employeeSalaryslip/uploadzip', 'EmployeeSalaryslipController@uploadzip');
    Route::resource('/employeeSalaryslip', 'EmployeeSalaryslipController');
    
});	
