<?php 
namespace App\Modules\ManageCompanyTypes\Models;

use Illuminate\Database\Eloquent\Model;

class MlstCompanyTypes extends Model {

	public $timestamps = false;
    protected $connection = 'masterdb';
    protected $table = 'mlst_company_types';
    protected $fillable = [
		'id',
		'type_of_company',
        'status',      
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
