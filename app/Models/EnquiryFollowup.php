<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 May 2017 12:39:48 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EnquiryFollowup
 * 
 * @property int $id
 * @property int $enquiry_id
 * @property \Carbon\Carbon $followup_date_time
 * @property int $followup_by_employee_id
 * @property int $followup_entered_through
 * @property string $remarks
 * @property int $call_recording_log_type
 * @property string $call_recording_id
 * @property \Carbon\Carbon $next_followup_date
 * @property \Carbon\Carbon $next_followup_time
 * @property \Carbon\Carbon $actual_followup_date_time
 * @property int $sales_category_id
 * @property int $sales_subcategory_id
 * @property int $sales_status_id
 * @property int $sales_substatus_id
 * @property int $finance_category_id
 * @property int $finance_subcategory_id
 * @property int $finance_status_id
 * @property int $finance_substatus_id
 * @property \Carbon\Carbon $created_date
 * @property \Carbon\Carbon $created_at
 * @property int $created_by
 * @property string $created_IP
 * @property string $created_browser
 * @property string $created_mac_id
 * @property \Carbon\Carbon $updated_date
 * @property \Carbon\Carbon $updated_at
 * @property int $updated_by
 * @property string $updated_IP
 * @property string $updated_browser
 * @property string $updated_mac_id
 * @property int $deleted_status
 * @property \Carbon\Carbon $deleted_date
 * @property int $deleted_by
 * @property int $deleted_IP
 * @property int $deleted_browser
 * @property int $deleted_mac_id
 *
 * @package App\Models
 */
class EnquiryFollowup extends Eloquent
{
	protected $casts = [
		'enquiry_id' => 'int',
		'followup_by_employee_id' => 'int',
		'followup_entered_through' => 'int',
		'call_recording_log_type' => 'int',
		'sales_category_id' => 'int',
		'sales_subcategory_id' => 'int',
		'sales_status_id' => 'int',
		'sales_substatus_id' => 'int',
		'finance_category_id' => 'int',
		'finance_subcategory_id' => 'int',
		'finance_status_id' => 'int',
		'finance_substatus_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'deleted_status' => 'int',
		'deleted_by' => 'int',
		'deleted_IP' => 'int',
		'deleted_browser' => 'int',
		'deleted_mac_id' => 'int'
	];

	protected $dates = [
		'followup_date_time',
		'next_followup_date',
		'next_followup_time',
		'actual_followup_date_time',
		'created_date',
		'updated_date',
		'deleted_date'
	];

	protected $fillable = [
		'enquiry_id',
		'followup_date_time',
		'followup_by_employee_id',
		'followup_entered_through',
		'remarks',
		'call_recording_log_type',
		'call_recording_id',
		'next_followup_date',
		'next_followup_time',
		'actual_followup_date_time',
		'sales_category_id',
		'sales_subcategory_id',
		'sales_status_id',
		'sales_substatus_id',
		'finance_category_id',
		'finance_subcategory_id',
		'finance_status_id',
		'finance_substatus_id',
		'created_date',
		'created_by',
		'created_IP',
		'created_browser',
		'created_mac_id',
		'updated_date',
		'updated_by',
		'updated_IP',
		'updated_browser',
		'updated_mac_id',
		'deleted_status',
		'deleted_date',
		'deleted_by',
		'deleted_IP',
		'deleted_browser',
		'deleted_mac_id'
	];
}
