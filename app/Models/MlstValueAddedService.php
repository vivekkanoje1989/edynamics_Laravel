<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 22 Sep 2017 09:52:06 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MlstValueAddedService
 * 
 * @property int $id
 * @property string $service_name
 * @property \Carbon\Carbon $created_date
 * @property \Carbon\Carbon $created_at
 * @property int $created_by
 * @property \Carbon\Carbon $updated_date
 * @property \Carbon\Carbon $updated_at
 * @property int $updated_by
 *
 * @package App\Models
 */
class MlstValueAddedService extends Eloquent
{
     protected $connection = 'masterdb';
     
	protected $casts = [
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
//		'created_date',
//		'updated_date'
	];

	protected $fillable = [
		'service_name',
		'hsn_sac',
		'created_date',
		'created_by',
		'updated_date',
		'updated_by'
	];
}
