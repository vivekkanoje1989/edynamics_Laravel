<?php namespace App\Modules\TaskManagement\Models;

use Illuminate\Database\Eloquent\Model;

class TaskManagement extends Model {

	protected $primaryKey = 'id';
	protected $connection = 'mysql';
    public $table = 'tm_task_list';
    public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'sub_product_id',
		'modules_id',
		'sub_modules_id',
		'department_id',
		'developer_employee_id',
		'tester_employee_id',
		'support_employee_id',
		'assign_by',
		'task_details',
		'task_screenshots',
		'task_note',
		'issued_date',
		'estimated_date',
		'task_priority',
		'developer_task_status',
		'tester_task_status',
		'support_task_status',
		'task_status',
		'completion_date',
		'remark',
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
		'deleted_status',
		'deleted_date',
		'deleted_by',
		'deleted_IP',
		'deleted_browser',
		'deleted_mac_id',
	];

}
