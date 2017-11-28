<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 22 Sep 2017 09:53:55 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Discount
 * 
 * @property int $id
 * @property int $client_id
 * @property int $subscribed_service_id
 * @property string $discount_amt
 * @property int $discount_for_id
 * @property string $applicable_month
 * @property int $status
 * @property \Carbon\Carbon $created_date
 * @property \Carbon\Carbon $created_at
 * @property int $created_by
 * @property \Carbon\Carbon $updated_date
 * @property \Carbon\Carbon $updated_at
 * @property int $updated_by
 *
 * @package App\Models
 */
class Discount extends Eloquent
{
	protected $table = 'discount';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'client_id' => 'int',
		'subscribed_service_id' => 'int',
		'discount_for_id' => 'int',
		'status' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
//		'created_date',
//		'updated_date'
	];

	protected $fillable = [
		'id',
		'client_id',
		'subscribed_service_id',
		'discount_amt',
		'discount_for_id',
		'applicable_month',
		'status',
		'created_date',
		'created_by',
		'updated_date',
		'updated_by'
	];
}
