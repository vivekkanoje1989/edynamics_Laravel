<?php 
namespace App\Modules\ManageGender\Models;

use Illuminate\Database\Eloquent\Model;

class Mlstgender extends Model {

	public $timestamps = false;
    protected $connection = 'masterdb';
    protected $primaryKey = 'id';
    protected $table = 'mlst_genders';
    protected $casts = [
        'id' => 'int',     
    ];
    
    protected $fillable = [
        'id',
        'gender',
        'status',
        'created_date',
        'created_at',
        'created_by',
        'created_IP',
        'created_browser',
        'created_mac_id',
    ];

}
