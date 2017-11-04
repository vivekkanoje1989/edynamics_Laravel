<?php 

namespace App\Modules\ManageClientRole\Models;

use Illuminate\Database\Eloquent\Model;

class mlstclientroles extends Model {

	public $timestamps = false;
	protected $connection = 'masterdb';
	protected $table = 'mlst_client_roles';
    protected $primaryKey = 'id';
    protected $casts = [
        'id' => 'int',
     
    ];
    
    protected $fillable = [
        'id',
        'role_name',
        'status',
        'created_date',
        'created_at',
        'created_by',
        'created_IP',
        'created_browser',
        'created_mac_id',
    ];

}