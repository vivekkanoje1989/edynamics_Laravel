<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 04 Mar 2017 11:59:16 +0530.
 */

namespace App\Modules\ManageLostReason\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class EnquiryLostReason
 * 
 * @property int $id
 * @property int $client_id
 * @property int $vertical_id
 * @property string $reason
 * @property int $lost_reason_status
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
 *
 * @package App\Models
 */
class EnquiryLostReason extends Eloquent
{
       // protected $primaryKey = 'id';
	protected $casts = [
		'client_id' => 'int',
		'vertical_id' => 'int',
		'lost_reason_status' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'created_date',
		'updated_date'
	];

	protected $fillable = [
		'client_id',
		'vertical_id',
		'reason',
		'lost_reason_status',
		'created_date',
		'created_by',
		'created_IP',
		'created_browser',
		'created_mac_id',
		'updated_date',
		'updated_by',
		'updated_IP',
		'updated_browser',
		'updated_mac_id'
	];
}
