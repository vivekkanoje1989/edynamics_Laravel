<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 Mar 2017 16:29:09 +0530.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ClientGroup
 * 
 * @property int $id
 * @property int $group_name
 *
 * @package App\Models
 */
class ClientGroup extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;
        protected $connection = 'masterdb';
        

	protected $casts = [
		'id' => 'int',
		'group_name' => 'string'
	];

	protected $fillable = [
		'id',
		'group_name'
	];
}
