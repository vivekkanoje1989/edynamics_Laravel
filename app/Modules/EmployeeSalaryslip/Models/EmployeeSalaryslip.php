<?php namespace App\Modules\EmployeeSalaryslip\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryslip extends Model {

	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $table = 'ph2_employee_salary_details';
    protected $casts = [
        'id' => 'int'
    ];
    protected $fillable = [
        'client_id',
        'employee_id',
        'heading_name',
        'salaryslip_docName',
        'amount',
        'month',
		'type_of_payment',
		'remarks',
		'status',
        'created_date',
        'created_at',
        'created_by',
        'created_IP',
        'created_browser',
        'created_mac_id',
        'updated_date',
        'updated_at',
        'updated_by',
        'updated_IP',
        'updated_browser',
        'updated_mac_id',
    ];

}
