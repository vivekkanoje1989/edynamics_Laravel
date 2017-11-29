<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 30 Jun 2017 16:44:22 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Booking
 * 
 * @property int $id
 * @property int $enquiry_id
 * @property int $model_id
 * @property string $model_name
 * @property int $sub_model_id
 * @property string $submodel_name
 * @property int $variant_id
 * @property string $variant_name
 * @property int $subvariant_id
 * @property string $subvariant_name
 * @property int $transmission_id
 * @property string $transmission_name
 * @property int $engine_id
 * @property string $engine_name
 * @property int $fuel_id
 * @property string $fuel_name
 * @property int $color_id
 * @property string $color_name
 * @property string $chasis_number
 * @property string $engine_number
 * @property string $registration_number
 * @property int $sales_person_id
 * @property int $booking_status_id
 * @property int $booking_confirmation_status_id
 * @property int $total_recievable_amount
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
class AccInvoice extends Eloquent
{
   /* SELECT `id`, `invoice_id`, `client_id`, `invoice_date`, `due_date`, `invoice_no`, `child_invoice_no`, `for_child`, `child_invoice_allowed`, 
    * `child_invoice_closed`, `total_amount`, `servicetax_total`, `invoice_file`, `created_date`, `created_at`, `created_by`, 
    * `created_IP`, `created_browser`, `created_mac_id`, `updated_date`, `updated_at`, `updated_by`, `updated_IP`,
    *  `updated_browser`, `updated_mac_id`, `deleted_status`, `deleted_date`, `deleted_by`, `deleted_IP`, `deleted_browser`, 
    * `deleted_mac_id` FROM `acc_invoices` WHERE 1*/
        protected $connection = 'masterdb';
        
	protected $casts = [
                'invoice_id'=> 'int',
		'client_id' => 'int',
		'child_invoice_no' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'deleted_status' => 'int',
		'deleted_by' => 'int',
		'deleted_IP' => 'int',
		'deleted_browser' => 'int',
		'deleted_mac_id' => 'int'
	];

	

	protected $fillable = [
		'client_id',
                'invoice_id',
		'invoice_date',
		'due_date',
		'invoice_no',
		'child_invoice_no',
		'for_child',
		'child_invoice_allowed',
		'child_invoice_closed',
		'total_amount',
		'servicetax_total',
		'invoice_file',
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
