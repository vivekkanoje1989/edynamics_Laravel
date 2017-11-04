<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 06 Feb 2017 05:28:47 +0000.
 */

namespace App\Modules\BloodGroups\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class LstBloodGroup
 * 
 * @property int $blood_group_id
 * @property string $blood_group
 *
 * @package App\Models
 */
class MlstBloodGroups extends Eloquent
{
	protected $primaryKey = 'blood_group_id';
	protected $connection = 'masterdb';
    public $table = 'mlst_blood_groups';
    public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'blood_group_id' => 'int'
	];

	protected $fillable = [
		'blood_group',
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
