<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 22 Sep 2017 09:55:17 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SubscribedService
 * 
 * @property int $id
 * @property int $client_id
 * @property int $service_id
 * @property string $unit
 * @property string $price
 * @property string $pri
 * @property string $pri_price
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
class SubscribedService extends Eloquent
{
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'client_id' => 'int',
		'service_id' => 'int',
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
		'service_id',
		'unit',
		'price',
		'pri',
		'pri_price',
		'status',
		'created_date',
		'created_by',
		'updated_date',
		'updated_by'
	];
}
