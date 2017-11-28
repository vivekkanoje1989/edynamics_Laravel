<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 May 2017 16:40:16 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ClientContactPerson
 * 
 * @property int $id
 * @property int $group_id
 * @property string $client_id
 * @property int $person_type
 * @property int $parent_id
 * @property int $title_id
 * @property string $first_name
 * @property string $last_name
 * @property int $designation_id
 * @property int $gender_id
 * @property int $mobile_number
 * @property string $password
 * @property int $high_security_password_type
 * @property int $high_security_password
 * @property int $email_id
 * @property string $permitted_citiy_ids
 * @property string $permitted_database_types
 * @property int $sms_credits
 * @property int $email_credits
 * @property int $status
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
class ClientContactPerson extends Eloquent
{
	protected $table = 'client_contact_persons';
        protected $connection = 'masterdb';
	protected $casts = [
		'group_id' => 'int',
		'person_type' => 'int',
		'parent_id' => 'int',
		'title_id' => 'int',
		'designation_id' => 'int',
		'gender_id' => 'int',
		'mobile_number' => 'int',
		'high_security_password_type' => 'int',
		'high_security_password' => 'int',
		'sms_credits' => 'int',
		'email_credits' => 'int',
		'status' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int',
		'deleted_status' => 'int',
		'deleted_by' => 'int',
		'deleted_IP' => 'int',
		'deleted_browser' => 'int',
		'deleted_mac_id' => 'int'
	];

	protected $dates = [
		'created_date',
		'updated_date',
		'deleted_date'
	];

	protected $hidden = [
		//'password',
		//'high_security_password'
	];

	protected $fillable = [
		'group_id',
		'client_id',
		'person_type',
		'parent_id',
		'title_id',
		'first_name',
		'last_name',
		'designation_id',
		'gender_id',
		'mobile_number',
		'password',
		'high_security_password_type',
		'high_security_password',
		'email_id',
		'permitted_citiy_ids',
		'permitted_database_types',
		'sms_credits',
		'email_credits',
		'status',
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
