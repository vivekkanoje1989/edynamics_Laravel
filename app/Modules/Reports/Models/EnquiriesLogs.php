<?php
namespace App\Modules\MasterSales\Models;
use Illuminate\Database\Eloquent\Model;

class EnquiriesLogs extends Model
{
	protected $casts = [
		'main_record_id' => 'int',
		'client_id' => 'int',
		'customer_id' => 'int',
		'sales_employee_id' => 'int',
		'sales_source_id' => 'int',
		'sales_subsource_id' => 'int',
		'sales_status_id' => 'int',
		'sales_substatus_id' => 'int',
		'sales_category_id' => 'int',
		'sales_subcategory_id' => 'int',
		'max_budget' => 'int',
                'quotation_given' => 'int',
		'test_drive_given' => 'int',
                'exchange_required' => 'int',
		'exchange_required_from' => 'int',
		'exchange_employee_id' => 'int',
		'exchange_source_id' => 'int',
		'exchange_subsource_id' => 'int',
		'exchange_source_discription' => 'int',
		'exchange_category_id' => 'int',
		'exchange_subcategory_id' => 'int',
		'exchange_status_id' => 'int',
		'exchange_substatus_id' => 'int',
		'exchange_enquiry_form_status' => 'int',
		//'max_rent_budget' => 'int',
		//'max_deposit' => 'int',
		'created_by' => 'int',
	];

	protected $dates = [
		'sales_enquiry_date',
		'finance_enquiry_date',
                'exchange_enquiry_date',
		'created_date',
	];

	protected $fillable = [
		'main_record_id',
		'client_id',
		'customer_id',
		'sales_enquiry_date',
		'sales_employee_id',
		'sales_source_id' ,
		'sales_subsource_id' ,
		'sales_source_description' ,
		'sales_status_id',
		'sales_substatus_id',
		'sales_category_id',
		'sales_subcategory_id',
		'sales_enquiry_form_token',
		'sales_enquiry_form_status',
		'enquiry_locations',
		//'parking_required',
		'max_budget',
		//'max_rent_budget',
		//'max_deposit',
		'payment_mode',
		//'payment_instalments',
		'quotation_given',
		'test_drive_given',
		'finance_required',
		'finance_required_from',
		'finance_enquiry_date',
		'finance_employee_id',
		'finance_source_id',
		'finance_subsource_id',
		'finance_source_discription',
		'finance_category_id',
		'finance_subcategory_id',
		'finance_status_id',
		'finance_substatus_id',
		'finance_enquiry_form_token',
		'finance_enquiry_form_status',
		'exchange_required',
		'exchange_required_from',
		'exchange_enquiry_date',
		'exchange_employee_id',
		'exchange_source_id',
		'exchange_subsource_id',
		'exchange_source_discription',
		'exchange_category_id',
		'exchange_subcategory_id',
		'exchange_status_id',
		'exchange_substatus_id',
		'exchange_enquiry_form_status',
		'exchange_enquiry_form_token',
		'created_date',
		'created_by',
		'created_IP',
		'created_browser',
		'created_mac_id',
		'record_type',
		'column_names',
		'record_restore_status',
	];
}
