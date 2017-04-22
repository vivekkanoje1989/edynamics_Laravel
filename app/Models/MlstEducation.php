<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 18 Jan 2017 09:04:39 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MlstEducation
 * 
 * @property int $blood_group_id
 * @property string $blood_group
 *
 * @package App\Models
 */
class MlstEducation extends Eloquent
{
	protected $primaryKey = 'id';

	protected $connection = 'masterdb';

	public $timestamps = false;
	protected $fillable = [
		'education',
                'education_id',
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
